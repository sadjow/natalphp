<?php
namespace NatalPHP\Db\Proxies;
/* SVN FILE: $Id: ProxyPDO.php 65 2010-04-10 00:49:11Z waldsonpatricio $ */
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
 * @subpackage    NatalPHP.NatalPHP.Db.Proxies
 * @since         NatalPHP(tm) v 0.1
 * @version       $Rev: 65 $
 * @modifiedby    $LastChangedBy: waldsonpatricio $
 * @lastmodified  $Date: 2010-04-10 00:49:11 +0000 (Sat, 10 Apr 2010) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
require_once dirname(dirname(__DIR__)) . '/Base/NatalPhpObject.php';
/**
 * Lazy and improved(now you can get object params) version of PDO php class
 *
 * @package       NatalPHP
 * @subpackage    NatalPHP.NatalPHP.Db.Proxies
 */
class ProxyPDO extends \PDO implements \NatalPhp\Base\NatalPHPObject {
    private $pdoObject      = null;
    private $dsn            = null;
    private $user           = null;
    private $password       = null;
    private $driverOptions  = null;

    public function __construct($dsn, $user = null, $password = null, $driver_options = null) {
        $this->dsn           = $dsn;
        $this->user          = $user;
        $this->password      = $password;
        $this->driverOptions = $driver_options;
    }


    private function getPDO() {
        if ($this->pdoObject == null) {
            
            $this->pdoObject = new \PDO($this->dsn, $this->user, $this->password, $this->driverOptions);
            $this->pdoObject->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        return $this->pdoObject;
    }

    public function beginTransaction() {
        return $this->getPDO()->beginTransaction();
    }

    public function commit() {
        return $this->getPDO()->commit();
    }

    public function errorCode() {
        return $this->getPDO()->commit();
    }

    public function prepare ($statement, $driverOptions = array()) {
        return $this->getPDO()->prepare($statement, $driverOptions);
    }

    public function rollBack () {
        return $this->getPDO()->rollBack();
    }

    public function setAttribute ($attribute, $value) {
        return $this->getPDO()->setAttribute($attribute, $value);
    }

    public function exec ($statement) {
        return $this->getPDO()->exec($statement);
    }

    public function query ($statement) {
        return $this->getPDO()->query($statement);
    }

    public function lastInsertId ($name = null) {
        return $this->getPDO()->lastInsertId($name);
    }

    public function errorInfo () {
        return $this->getPDO()->errorInfo();
    }

    public function getAttribute ($attribute) {
        return $this->getPDO()->getAttribute($attribute);
    }

    public function quote ($string, $parameterType = null) {
        return $this->getPDO()->quote($string, $parameterType);
    }

    public function getDsn() {
        return $this->dsn;
    }

    public function getUser() {
        return $this->user;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getDriverOptions() {
        return $this->driverOptions;
    }

}

