<?php
namespace NatalPHP\Db\Objects;
use \NatalPHP\Db\Connections\DefaultConnector;

require_once __DIR__ . '/Dao.php';
require_once dirname(__DIR__) . '/Connections/DefaultConnector.php';
/* SVN FILE: $Id$ */
/**
 *
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
 * @version       $Rev$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

class GenericDao extends Dao {

    public function __construct(Connection $conn = null) {
        $conn = $conn === null ? $this->getConnection() : $conn;
        parent::__construct($conn);
    }

    public function delete($tableName, $conditions = null, $params = array(), $limit = 1) {
        $sql = 'DELETE FROM ' . $tableName;

        if (!is_null($conditions)) {
            $sql .= ' WHERE ' . $conditions;
        }
        if ($limit !== null) {
            if (preg_match('#^[0-9]+( *, *[0-9]+)?$#', trim($limit))) {
                $sql .= ' LIMIT ' . $limit;
            } else
                return -1;
            
        }

        return $this->getConnection()->execute($sql,  $params);
    }

    public function get($tableName, $conditions = null, $params = array(), $fields = array(), $order = null, $limit = 1) {
        $sql = 'SELECT %s FROM %s';
        $fields = empty($fields) ? '*' : implode(', ', $fields);
        $sql = sprintf($sql, $fields, $tableName);

        if (!is_null($conditions)) {
            $sql .= ' WHERE ' . $conditions;
        }

        if ($order !== null) {
            $sql .= ' ORDER BY ' . $order;
        }
        if ($limit !== null) {
            if (preg_match('#^[0-9]+( *, *[0-9]+)?$#', trim($limit))) {
                $sql .= ' LIMIT ' . $limit;
            } else {
                return -1;
            }
        }

        return $this->getConnection()->queryAll($sql, $params);
    }



    public function insert($tableName, $data) {
        if (empty($data))
            return null;
        $fields = array_keys($data);
        $sql = 'INSERT INTO %s(%s) VALUES (%s)';
        $sql = sprintf($sql, $tableName, implode(', ', $fields ), implode(', ', array_map(array($this, '_putCollon'), $fields)));
        $this->getConnection()->execute($sql, $data);
        return $this->getConnection()->lastInsertId();
    }



    /**
     * Override to create your own connection
     * @return \NatalPHP\Db\Connections\Connection
     */
    public function getConnection() {
        return DefaultConnector::getConnection();
    }

    private function _prepareUpdate($var) {
        return $var . '= :' . $var;
    }
    private function _putCollon($var) {
        return ':' . $var;
    }

    public function update($tableName, $data, $conditions = null, $params = array(), $limit = 1) {
        if (empty($data))
            return -1;
        $fields = array_keys($data);
        $sql = 'UPDATE %s SET %s';
        $sql = sprintf($sql, $tableName, implode(', ', array_map(array($this, '_prepareUpdate'), $fields) ));

        if (!is_null($conditions)) {
            $sql .= ' WHERE ' . $conditions;
        }

        if (preg_match('#^[0-9]+( *, *[0-9]+)?$#', trim($limit))) {
            $sql .= ' LIMIT ' . $limit;
        } else if ($limit !== null) {
            return -1;
        }

        return $this->getConnection()->execute($sql, array_merge($data, $params));
    }
}
