<?php
namespace NatalPhp\Db\Connections;
/* SVN FILE: $Id: PDOConnection.php 52 2010-01-10 22:32:35Z Sadjow $ */
/**
 * PdoConnection class file.
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
require_once dirname(__DIR__) . '/Proxies/ProxyPdo.php';

/**
 * PdoConnection class.
 *
 * @package       NatalPHP
 * @subpackage    NatalPHP.NatalPHP.Db.Connection
 */
class PDOConnection extends Connection {

    private $pdoObject = null;
    private $dsn       = null;
    private $user      = null;
    private $password  = null;
    private $driver_options = null;
    
    function __construct($dsn, $user = null, $password = null, $driver_options = null) {
        $this->dsn = $dsn;
        $this->user = $user;
        $this->password = $password;
        $this->driver_options = $driver_options;
        $this->connect();
    }

   

    function connect() {
        try {
            $this->pdoObject = new \NatalPhp\Db\Proxies\ProxyPDO($this->dsn, $this->user, $this->password, $this->driver_options);
        } catch (\PDOException $ex) {
            throw new ConnectionException($ex->getMessage());
        }
    }

    function isConnected() {
        return $this->pdoObject != null;
    }

    function disconnect() {
        $this->pdoObject = null;
    }

    function query($query, array $params = array(), $fetchMode = null) {
        try {
            if ($fetchMode === null)
                $fetchMode = $this->getDefaultFetchMode();
            static $previousParams = null;
            static $stmt = null;

            if (is_null($stmt) || $stmt->queryString != $query) {
                $stmt = $this->pdoObject->prepare($query);
            }
            if ($previousParams === null || $previousParams !== $params) {
                $stmt->execute($params);
                $previousParams = $params;
            }
            return $stmt->fetch($fetchMode);
        } catch (\PDOException $ex) {
            throw new ConnectionException($ex->getMessage());
        }
    }

    function queryAll($query,array $params = array(), $fetchMode = null) {
        try {
            if ($fetchMode === null)
                $fetchMode = $this->getDefaultFetchMode();
            $stmt = $this->pdoObject->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll($fetchMode);
        } catch (\PDOException $ex) {
            throw new ConnectionException($ex->getMessage());
        }
    }

    function execute($query, array $params = array()) {
        try {
            static $stmt = null;
            if ($stmt == null || $stmt->queryString != $query)
                $stmt = $this->pdoObject->prepare($query);
            $stmt->execute($params);
            return $stmt->rowCount();
        } catch (\PDOException $ex) {
            throw new ConnectionException($ex->getMessage());
        }
    }

    function beginTransaction() {
        try {
            return $this->pdoObject->beginTransaction();
        } catch (\PDOException $ex) {
            throw new ConnectionException($ex->getMessage());
        }
    }

    function commit() {
        try {
            return $this->pdoObject->commit();
        } catch (\PDOException $ex) {
            throw new ConnectionException($ex->getMessage());
        }
    }

    function rollback() {
        try {
            return $this->pdoObject->rollback();
        } catch (\PDOException $ex) {
            throw new ConnectionException($ex->getMessage());
        }
    }

    function lastInsertId() {
        try {
            return $this->pdoObject->lastInsertId();
        } catch (\PDOException $ex) {
            throw new ConnectionException($ex->getMessage());
        }
    }
}
