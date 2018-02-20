<?php
namespace NatalPHP\Db\Connections;
/* SVN FILE: $Id: Connection.php 51 2010-01-10 22:31:30Z Sadjow $ */
/**
 * Connection class file.
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
 * @version       $Rev: 51 $
 * @modifiedby    $LastChangedBy: Sadjow $
 * @lastmodified  $Date: 2010-01-10 22:31:30 +0000 (Sun, 10 Jan 2010) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

require_once __DIR__ . '/ConnectionException.php';
require_once dirname(dirname(__DIR__)) . '/Base/NatalPhpObject.php';

/**
 * Abstract Class that represents a Connection with database
 *
 * @package       NatalPHP
 * @subpackage    NatalPHP.NatalPHP.Db.Connection
 */
abstract class Connection implements \NatalPHP\Base\NatalPHPObject {
    const FETCH_ASSOC = \PDO::FETCH_ASSOC;
    const FETCH_NUM   = \PDO::FETCH_NUM;
    const FETCH_BOTH  = \PDO::FETCH_BOTH;
    const FETCH_OBJ   = \PDO::FETCH_OBJ;

    /**
     * Hold the default fetch mode. If fetch mode params isn't passed to the
     * functions, the default fetch mode is used
     * @var $defaultFetchMode int
     */
    private $defaultFetchMode = self::FETCH_ASSOC;

    /**
     * Connect to the database
     * @throws ConnectionException
     */
    abstract function connect();

    /**
     * Check if it's connected to database
     * @return boolean true if connected, false otherwise
     */
    abstract function isConnected();

    /**
     * Disconnect database
     * @throws ConnectionException
     */
    abstract function disconnect();


    /**
     *Query the database and return an array with result of the first row.
     * The query param can also be in prepared statement query style
     * @param string $query the sql
     * @param array $params the prepared statement params
     * @param int $fetchMode query fetch mode
     * @return array query result
     * @throws ConnectionException
     */
    abstract function query($query, array $params = array(), $fetchMode = null);

    /**
     *Query the database and return an array with result.
     * The query param can also be in prepared statement query style
     * @param string $query the sql
     * @param array $params the prepared statement params
     * @param int $fetchMode query fetch mode
     * @return array query result
     * @throws ConnectionException
     */
    abstract function queryAll($query, array $params = array(), $fetchMode = null);

    /**
     * Execute query in database without return value
     * The query param can also be in prepared statement query style
     * @param string $query the sql
     * @param array $params the prepared statement params
     * @return int affected rows
     * @throws ConnectionException
     */
    abstract function execute($query,array $params = array());

    /**
     * Init a transaction in database
     * @return bool
     * @throws ConnectionException
     */
    abstract function beginTransaction();

    /**
     * Commit a transaction
     * @return bool
     * @throws ConnectionException
     */
    abstract function commit();

    /**
     * Roolback a transaction
     * @return bool
     * @throws ConnectionException
     */
    abstract function rollback();

    /**
     * Get the last insert id
     * @return int
     * @throws ConnectionException
     */
    abstract function lastInsertId();

    /**
     * Set the default fetch mode
     * @param $fetchMode int fetch mode
     * @return void
     */
    function setDefaultFetchMode($fetchMode) {
        $this->defaultFetchMode = $fetchMode;
    }

    /**
     * Returns the default fetch mode
     * @return int fetch mode
     */
    function getDefaultFetchMode() {
        return $this->defaultFetchMode;
    }

    /**
     * @return bool
     * @throws ConnectionException
     */
    function __destruct() {
        $this->disconnect();
    }

}

