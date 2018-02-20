<?php
namespace NatalPHP\Db\Connections;
/* SVN FILE: $Id: MySQLConnection.php 52 2010-01-10 22:32:35Z Sadjow $ */
/**
 * MySQLConnection class file.
 *
 * NatalPHP (tm) :  Sufficient and Simple Framework (http://www.trycatch.com.br)
 * Copyright 2010 Sadjow Medeiros Leão <sadjow[at]gmail.com>,
 * Waldson Patricio <waldsonpatricio[at]gmail.com
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2010 Sadjow Medeiros Leão <sadjow[at]gmail.com>,
 *                Waldson Patricio <waldsonpatricio[at]gmail.com
 * @link          http://www.trycatch.com.br Natal(tm) Project
 * @package       NatalPHP
 * @subpackage    NatalPHP.NatalPHP.Db.Connection
 * @since         NatalPHP(tm) v 0.1
 * @version       $Rev: 52 $
 * @modifiedby    $LastChangedBy: Sadjow $
 * @lastmodified  $Date: 2010-01-10 22:32:35 +0000 (Sun, 10 Jan 2010) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
require_once __DIR__ . '/Connection.php';
/**
 * MySQLConnection class.
 *
 * @package       NatalPHP
 * @subpackage    NatalPHP.NatalPHP.Db.Connection
 */
class MySQLConnection extends Connection {
    private $connection;
    private $host;
    private $user;
    private $password;
    private $dbName;

    function __construct($host, $user, $password, $dbName) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->dbName   = $dbName;
        $this->connect();
    }


    function connect() {
        $conn = @mysql_connect($this->getHost(), $this->getUsername(), $this->getPassword());
        if (!$conn)
            throw new ConnectionException(mysql_error(), mysql_errno());
        $db   = @mysql_select_db($this->getDbName(), $conn);
        if (!$db)
            throw new ConnectionException(mysql_error(), mysql_errno());
        $this->connection = $conn;
    }

    function isConnected() {
        return gettype($this->connection) == 'resource';
    }

    function disconnect() {
        if ($this->isConnected()) {
            $close = @mysql_close($this->connection);
            if (!$close)
                throw new ConnectionException(mysql_error(), mysql_errno());
            return $close;
        }
        return false;
    }

    function query($query, array $params = array(), $fetchMode = null) {
        if (!$this->isConnected())
            throw new ConnectionException('Not connected.');
        if ($fetchMode === null)
            $fetchMode = $this->getDefaultFetchMode();
        static $cacheQuery = null, $cacheParams = null, $cacheResource = null;
        if ($cacheQuery === $query && $params === $cacheParams && !is_null($cacheResource)) {
            return $this->fetch($cacheResource, $fetchMode);
        }
        $cacheQuery  = $query;
        $cacheParams = $params;
        $query = $this->parseQuery($query, $params);
        $rsc = @mysql_query($query);

        if (!$rsc)
            throw new ConnectionException(mysql_error(), mysql_errno());

        $row = $this->fetch($rsc, $fetchMode);
        $cacheResource = $rsc;
        return $row;
    }

    private function fetch($queryResource, $fetchMode) {
        if (!is_resource($queryResource))
            throw new ConnectionException('Invalid MySQL result resource.');
        switch ($fetchMode) {
            case Connection::FETCH_ASSOC :
                return mysql_fetch_array($queryResource, MYSQL_ASSOC);
            case Connection::FETCH_OBJ :
                return mysql_fetch_object($queryResource);
                break;
            case Connection::FETCH_NUM :
                return mysql_fetch_array($queryResource, MYSQL_NUM);
                break;
            default:
                return mysql_fetch_array($queryResource, MYSQL_BOTH);
        }
    }

    function queryAll($query,array $params = array(), $fetchMode = null) {
        $dados = array();
        while (($tmp = $this->query($query, $params, $fetchMode)) !== false) {
            $dados[] = $tmp;
        }
        return $dados;
    }

    function execute($query, array $params = array()) {
        if (!$this->isConnected())
            throw new ConnectionException('Not connected.');

        $query = $this->parseQuery($query, $params);
        $rsc = @mysql_query($query);
        if (!$rsc)
            throw new ConnectionException(mysql_error(), mysql_errno());
        $affectedRows = @mysql_affected_rows($this->connection);
        if ($affectedRows == -1)
            throw new ConnectionException(mysql_error(), mysql_errno());
        return $affectedRows;
    }

    function beginTransaction() {
        return $this->execute('begin');
    }

    function commit() {
        return $this->execute('commit');
    }

    function rollback() {
        return $this->execute('rollback');
    }


    function lastInsertId() {
        if (!$this->isConnected())
            throw new ConnectionException('Not connected.');
        $id = @mysql_insert_id($this->connection);
        if ($id === false)
            throw new ConnectionException(mysql_error(), mysql_errno());
        return $id;
    }

    private function parseQuery($query, $params) {
        $total = preg_match_all('#(\?|:[a-z0-9_]+)#is', $query, $matches);
        if ($total <= 0)
            return $query;

        $statements = $matches[1];
        
        $uniqueParameters = array();
        foreach ($statements as $statement) {
            if ($statement != '?') {
                if (in_array($statement, $uniqueParameters))
                    continue;
            }
            $uniqueParameters[] = $statement;
        }
        $totalPositional = 0;
        $totalNamed      = 0;

        foreach ($statements as $statement) {
            if ($statement == '?')
                $totalPositional++;
            else
                $totalNamed++;
        }
        
        if ($totalNamed > 0 && $totalPositional > 0) {
            throw new ConnectionException('Invalid parameter number: mixed named and positional parameters');
        }

        if (count($params) != count($uniqueParameters)) {
            if (count($params) == 0)
                throw new ConnectionException("Invalid parameter number: no parameters were bound");
            else
                throw new ConnectionException('Invalid parameter number: number of bound variables does not match number of tokens');
        }

        $totalTokens = 0;
        foreach ($statements as $token) {
            if ($token == '?') {
                
                if (!array_key_exists($totalTokens, $params))
                    throw new ConnectionException('Invalid parameter number: number of bound variables does not match number of tokens');
                $value = $params[$totalTokens];
                $value = is_null($value) ? 'null' : $this->quote($value);
                $query = preg_replace('#\?#is', $value, $query, 1);
                $totalTokens++;
            } elseif (preg_match('#^:([a-z0-9_]+)#is', $token, $submatches)) {
                $offset = $submatches[1];
                if (!isset($params[$offset]))
                    throw new ConnectionException('Offset "'. $offset . '" does not exist in parameters array.');
                $regex = '#' . preg_quote(':' . $offset, '#') . '#is';
                $query = preg_replace($regex, $this->quote($params[$offset]), $query);
            }  else {
                throw new ConnectionException('Error on parse query.');
            }
        }

        return $query;
    }

    private function quote($value) {
        if (!$this->isConnected())
            throw new ConnectionException('Not connected.');
        $value = @mysql_real_escape_string($value, $this->connection);
        if ($value === false)
            throw new ConnectionException(mysql_error(), mysql_errno());
        return "'$value'";
    }

    public function getHost() {
        return $this->host;
    }

    public function getUsername() {
        return $this->user;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getDbName() {
        return $this->dbName;
    }
    
}
