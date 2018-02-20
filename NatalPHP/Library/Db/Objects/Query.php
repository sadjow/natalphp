<?php
namespace NatalPHP\Db\Objects;
use NatalPHP\Db\Connections\Connection;
use NatalPHP\Base\NatalPHPObject;
use \NatalPHP\Db\Connections\DefaultConnector;
require_once dirname(__DIR__) . '/Connections/DefaultConnector.php';
require_once dirname(dirname(__DIR__)) . '/Base/NatalPHPObject.php';

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
 * @subpackage    NatalPHP.Db.Objects
 * @since         NatalPHP(tm) v 0.1
 * @version       $Rev$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

class Query implements NatalPHPObject {
    protected $connection = null;
    protected $tableName  = null;

    protected $fields     = array();
    protected $conditions = array();
    protected $params     = array();
    protected $having     = null;
    protected $limit      = null;
    protected $offset     = null;
    protected $orderBy    = null;
    protected $groupBy    = null;
    protected $joins      = array();
  
    
    public function __construct($tableName, Connection $connection = null) {
        $this->tableName = $tableName;
        if ($connection === null)
            $connection = $this->getConnectionOnNull();
        $this->connection = $connection;
    }

    public function select($fields) {
        $params = func_get_args();
        $fields = array();
        foreach ($params as $fieldName) {
            if (is_array($fieldName))
                $fields = array_merge($fields, $fieldName);
            else
                $fields[] = $fieldName;
        }
        $this->fields = $fields;
        return $this;
    }

    private function _where($type, $condition, $params) {
        $this->conditions[] = array('type' => $type, 'condition' => $condition, 'params' => $params);
    }

    public function where($conditions, $params = array()) {
        $this->_where('AND', $conditions, $params);
        return $this;
    }

    public function orWhere($conditions, $params = array()) {
        $this->_where('OR', $conditions, $params);
        return $this;
    }

    public function andWhere($conditions, $params = array()) {
        $this->_where('AND', $conditions, $params);
        return $this;
    }

    protected function _join($type, $table, $conditions, $params) {
        $this->joins[] = array('type' => $type, 'table' => $table, 'condition' => $conditions, 'params' => $params);
    }

    public function join($table, $conditions = null, $params = array()) {
        $this->_join('INNER', $table, $conditions, $params);
        return $this;
    }

    public function leftJoin($table, $conditions = null, $params = array()) {
        $this->_join('LEFT', $table, $conditions, $params);
        return $this;
    }

    public function rightJoin($table, $conditions = null, $params = array()) {
        $this->_join('RIGHT', $table, $conditions, $params);
        return $this;
    }

    public function limit($limit, $offset = null) {      
        $this->limit  = $limit;
        $this->offset = $offset;
        return $this;
    }

    public function orderBy($orderBy) {
        $this->orderBy = $orderBy;
        return $this;
    }
    public function groupBy($groupBy, $having = null) {
        $this->groupBy = $groupBy;
        $this->having  = null;
        return $this;
    }

    public function fetch($oneRow = false) {
        $sql    = $this->_buildSql();
        $params = $this->_getAllParams();        
        if ($oneRow)
            return $this->connection->query($sql, $params);
        else
            return $this->connection->queryAll($sql, $params);
    }

    protected function _getAllParams() {
        $params = array();
        foreach ($this->conditions as $condition) {
            $params = array_merge($params, $condition['params']);
        }
        foreach ($this->joins as $join) {
            $params = array_merge($params, $join['params']);
        }
        return $params;
    }
    
    protected function _buildSql() {
        $sql = 'SELECT %s FROM %s';
        $fields = empty($this->fields) ? '*' : implode(', ', $this->fields);
        $sql = sprintf($sql, $fields, $this->tableName);

        if (!empty($this->joins)) {
            $joinStr = '';
            foreach ($this->joins as $join) {
                $joinStr .= ' ' . $join['type'] . ' JOIN ' . $join['table'] . ' ON ';
                $joinStr .= $join['condition'];
            }
            $sql .= $joinStr;
        }

        if (!empty($this->conditions)) {
            $whereStr = '';
            foreach ($this->conditions as $condition) {
                if (empty($whereStr))
                    $whereStr = ' WHERE ';
                else
                    $whereStr .= ' ' . $condition['type'] . ' ';
                $whereStr .= $condition['condition'];
            }
            $sql .= $whereStr;
        }

        if (!empty($this->groupBy)) {
            $sql .= ' GROUP BY ' . $this->groupBy;
        }

        if (!empty($this->having)) {
            $sql .= ' HAVING ' . $this->having;
        }

        if (!empty($this->orderBy)) {
            $sql .= ' ORDER BY ' . $this->orderBy;
        }

        if (!empty($this->limit)) {
            $limit = empty($this->offset) ? '' : $this->offset . ', ';
            $limit .= $this->limit;
            $sql   .= ' LIMIT ' . $limit;
        }        
        return $sql;
    }

    public function __toString() {
        return $this->_buildSql();
    }

    /**
     * @return Connection
     */
    protected function getConnectionOnNull() {
        return DefaultConnector::getConnection();
    }

    /**
     * @return Query
     */
    public static function create($tableName, Connection $connection = null) {
        return new Query($tableName, $connection);
    }

}
