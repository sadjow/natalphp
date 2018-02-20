<?php
namespace NatalPHP\Db\Objects;
use NatalPHP\CommonObjects\ObjectWithValidation;
use NatalPHP\Util\Inflection\Inflector;
use NatalPHP\Db\Objects\Dao;
use NatalPHP\Base\NatalPHPException;
use NatalPHP\Db\Objects\ModelBehaviors\Behavior;
require_once dirname(dirname(__DIR__)) . '/CommonObjects/ObjectWithValidation.php';
require_once dirname(dirname(__DIR__)) . '/Util/Inflection/Inflector.php';
require_once dirname(dirname(__DIR__)) . '/Base/NatalPHPException.php';
require_once __DIR__ . '/GenericDao.php';
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

class AbstractModel extends ObjectWithValidation {
    private $behaviors = array();
    private $dao       = null;
  

    function __construct(Dao $dao = null) {        
        $this->dao = $dao;        
    }

    function actAs(Behavior $behavior) {
        if ($behavior == null)
            return false;
        $this->behaviors[] = $behavior;
        return true;
    }
    
    function attachBehavior(Behavior $behavior) {
        return $this->actAs($behavior);
    }
    
    function detachBehavior(Behavior $behavior) {
        $key = array_search($behavior, $this->behaviors);
        if ($key === false)
            return false;
        unset($this->behaviors[$key]);
        return true;
    }

    function hasBehavior(Behavior $behavior) {
        $key = array_search($behavior, $this->behaviors);
        return $key !== false;
    }

    function getBehaviors($classFilters = null, $useNamespaces = false) {
        $search = is_string($classFilters) || is_array($classFilters);
        if (!$search)
            return $this->behaviors;
        $behaviors = array();
        foreach ($this->behaviors as $behavior) {
            $class = $useNamespaces ? get_class($behavior) : basename(get_class($behavior));
            if (is_string($classFilters)) {
                if (strtolower($class) == strtolower($classFilters))
                    $behaviors[] = $behavior;
            } else {
                foreach ($classFilters as $otherClass) {
                    if (strtolower($class) == strtolower($otherClass))
                        $behaviors[] = $behavior;
                }
            }
        }
        return $behaviors;
    }


    function insert($validate = true) {
        if ($validate && !$this->validate())
            return false;
        $return = $this->triggerBeforeSave();
        //if beforesave callback return false doesn't save object
        if ($return === false)
            return false;
        $return = $this->triggerBeforeInsert();
        if ($return === false)
            return false;
        
        $id = $this->getDao()->insert($this->getTableName(), $this->toArray());
        $success = $id !== null;

        $this->triggerAfterSave($success);
        $this->triggerAfterInsert($success);

        if (!$success)
            return false;
        $this->set($this->getPk(), $id);
        return true;
    }

  

    function update($validate = true) {
        if ($validate && !$this->validate())
            return false;
        $pk = $this->getPk();
        if (!isset($this->{$pk}))
            return false;                
        $return = $this->triggerBeforeSave();       
        //if beforesave callback return false doesn't save object
        if ($return === false)
            return false;
        $return = $this->triggerBeforeUpdate();
        if ($return === false)
            return false;

        $data = $this->toArray();
        $id   = $data[$pk];
        unset($data[$pk]);
        $affectedRows = $this->getDao()->update($this->getTableName(), $data, "$pk=:$pk", array($pk => $id), 1);
        $success      = $affectedRows >= 0;
        $this->triggerAfterSave($success);
        $this->triggerAfterUpdate($success);

        return $success;
    }

    function delete() {
        $pk = $this->getPk();
        if (!isset($this->{$pk}))
            return false;
        $return = $this->triggerBeforeDelete();
        if ($return === false)
            return false;
        $id   = $this->get($pk);
        $affectedRows = $this->getDao()->delete($this->getTableName(),"$pk=:$pk", array($pk => $id), 1);
        $success      = $affectedRows == 1;
        $this->triggerAfterDelete($success);
        return $success;
    }

    function save($validate = true) {
        $pk = $this->getPk();
        if ($this->has($pk))
            return $this->update($validate);
        else
            return $this->insert($validate);
    }
    
    function fill($fields = array(), $orderBy = null) {
        $vars = $this->toArray();
        $conditions = array();
        foreach ($vars as $var => $value) {
            $conditions[] = "$var=:$var";
        }

        $conditions = implode(' AND ', $conditions);

        
        $data = $this->getDao()->get($this->getTableName(), $conditions, $vars, $fields, $orderBy, 1);
        if (!isset($data[0]))
            $data = array();
        else
            $data = $data[0];
        $tmpData = $this->triggerBeforeFill($data);
      
        //if beforefill callback returns false doesn't fill object
        if ($tmpData === false)
            return false;
        if (is_array($tmpData) && !empty($tmpData))
            $data = $tmpData;
        
        $success = !empty($data) && is_array($data);
        if ($success)
            $this->fillFromArray($data);
        $this->triggerAfterFill($success);
        return $success;
    }



    protected function setDao(Dao $dao) {
        if ($this->dao === null)
            throw new NatalPHPException('Dao cannot be null');
        $this->dao = $dao;
    }

    /**
     * @return Dao
     */
    protected function getDao() {
        if ($this->dao === null)
            $this->dao = $this->getDefaultDao();
        if ($this->dao === null)
            throw new NatalPHPException('Dao cannot be null');
        return $this->dao;
    }

    static function getTableName() {
        return Inflector::tableize(basename(get_called_class()));
    }

    static function getPk() {
        return 'id_' . Inflector::underscore(basename(get_called_class()));
    }


    static function findAll($conditions = null, $params = array(), $fields = array(), $order = null, $limit = null, Dao $dao = null) {
        if ($dao === null)
            $dao = self::getDefaultDao();
        return $dao->get(self::getTableName(), $conditions, $params, $fields, $order, $limit);
    }
    
    static function find($conditions = null, $params = array(), $fields = array(), $order = null, Dao $dao = null) {
        if ($dao === null)
            $dao = self::getDefaultDao();
        $data = $dao->get(self::getTableName(), $conditions, $params, $fields, $order, 1);
        if (!isset($data[0]))
            return null;
        return $data[0];        
    }

    static function findByPk($pkValue, Dao $dao = null) {        
         if ($dao === null)
            $dao = self::getDefaultDao();
         $pk   = self::getPk();
         $data = $dao->get(self::getTableName(), "$pk=:$pk", array($pk => $pkValue));
         if (!isset($data[0]))
             return null;
         return $data[0];
    }

    static function getDefaultDao() {
        static $dao;
        if (is_null($dao))
            $dao = new GenericDao();
        return $dao;
    }


    static function __callStatic($a, $b) {
        $find    = strpos(strtolower($a), 'findby') === 0;
        $findAll = strpos(strtolower($a), 'findallby') === 0;

        if ($find || $findAll) {
            $removePrefix = preg_replace('#^find(all)?by#is', '', $a);
            $parts    = preg_split('#(_and_|_or_)#i', $removePrefix, null, \PREG_SPLIT_DELIM_CAPTURE);
            
            $fields    = array();
            $operators = array();
            foreach ($parts as $part) {
                $lowerPart = strtolower($part);
                switch ($lowerPart) {
                    case '_and_' :
                        $operators[] = 'AND';
                        break;
                    case '_or_' :
                        $operators[] = 'OR';
                        break;
                    default:
                        $fields[] = $part;
                }
            }
            


            $countFields  = count($fields);
            $countParams = count($b);
            if ($countParams < $countFields)
                throw new NatalPHPException('Missing arguments for ' . $a . ' dynamic method. Expects: ' . $countFields . ', given: ' . $countParams  );
            $b = array_slice($b, 0, $countFields);
            $data = array_combine($fields, $b);
            
            $conditions = '';
            $isWhere    = true;
            foreach ($fields as $field) {
                if (!$isWhere)  {
                    $conditions .= ' ' . array_shift($operators) . ' ';
                }
                $conditions .= $field . '=:' . $field;
                if ($isWhere)
                    $isWhere = false;
            }            
            if ($find)
                return self::find($conditions, $data);
            else
                return self::findAll($conditions, $data);            
        }
        return null;
    }

   

    

    /*
     * Callbacks
     */
    function beforeSave() {}
    function afterSave($success) {}
    function beforeInsert() {}
    function afterInsert($success) {}
    function beforeDelete() {}
    function afterDelete($success) {}
    function beforeFill($data) {}
    function afterFill($success) {}
    function beforeUpdate(){}
    function afterUpdate($success) {}

    private function triggerBefore($type) {
        $function = null;
        switch ($type) {
            case 'save':
                $function = 'beforeSave';
                break;
            case 'update':
                $function = 'beforeUpdate';
                break;
            case 'insert':
                $function = 'beforeInsert';
                break;
            case 'delete':
                $function = 'beforeDelete';
                break;

            default:
                return;
        }
        $return = call_user_func(array($this, $function));
        foreach ($this->behaviors as $behavior) {
            if ($behavior->enabled()) {
                $returnBehavior = call_user_func(array($behavior, $function), &$this);
                if ($returnBehavior === false && $return !== false)
                    $return = false;
            }
        }
        return $return;
    }

    private function triggerAfter($type, $success) {
        $triggers = array('save', 'update', 'insert', 'delete', 'fill');
        if (!in_array(strtolower($type), $triggers))
            return false;
        $function = 'after' . $type;
        call_user_func(array($this, $function), $success);
        foreach ($this->behaviors as $behavior) {
            if ($behavior->enabled()) 
                call_user_func_array(array($behavior, $function), array(&$this, $success));
        }
        
    }

    protected function triggerBeforeSave() {       
        return $this->triggerBefore('save');
    }
    protected function triggerBeforeDelete() {
        return $this->triggerBefore('delete');
    }
    protected function triggerBeforeInsert() {
        return $this->triggerBefore('insert');
    }
    protected function triggerBeforeUpdate() {
        return $this->triggerBefore('update');
    }
    protected function triggerBeforeFill($data) {
        $return = $this->beforeFill($data);
        foreach ($this->behaviors as $behavior) {
            if ($behavior->enabled()) {
                $returnBehavior = $behavior->beforeFill($this, $data);
                if ($returnBehavior === false)
                    return false;
                if (!is_array($returnBehavior))
                    return;
                $data = $returnBehavior;
                $return = $data;
            }
        }
        return $return;
    }

    protected function triggerAfterSave($success) {
        return $this->triggerAfter('save', $success);
    }
    protected function triggerAfterDelete($success) {
        return $this->triggerAfter('delete', $success);
    }
    protected function triggerAfterInsert($success) {
        return $this->triggerAfter('insert', $success);
    }
    protected function triggerAfterUpdate($success) {
        return $this->triggerAfter('update', $success);
    }
    protected function triggerAfterFill($success) {
        return $this->triggerAfter('fill', $success);
    }

    function __call($method, $params) {
        //call behaviors methods if is callable
        foreach ($this->behaviors as $behavior) {
            if ($behavior->enabled()) {
                if (method_exists($behavior, $method)) {
                    $refMethod     = new \ReflectionMethod(get_class($behavior), $method);
                    $requiredCount = $refMethod->getNumberOfRequiredParameters();                    
                    $paramsCount   = count($params) + 1;
                    if ($paramsCount < $requiredCount) {
                        $debug    = debug_backtrace();
                        $caller   = $debug[1];
                        $class    = $caller['class'];
                        $function = $caller['function'];
                        $file     = $caller['file'];
                        $line     = $caller['line'];
                        throw new \ErrorException('Missing argument ' . $paramsCount . ' for ' . $class . '::' . $function, 0, \E_USER_WARNING, $file, $line);
                    }
                        
                    call_user_func_array(array($behavior, $method), array_merge(array(&$this), $params));
                }
            }
        }
    }
    
}
