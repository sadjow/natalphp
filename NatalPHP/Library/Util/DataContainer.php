<?php
namespace NatalPHP\Util;
use NatalPHP\Base\NatalPHPObject;
require_once dirname(__DIR__)  . '/Base/NatalPHPObject.php';
/* SVN FILE: $Id$ */
/**
 * Class for rapid var access and definition.
 * Examples:
 * $this->set('app.db.host', 'localhost');
 * $this->set('app.db.host2', 'localhost');
 * $this->has('app.db');
 * $this->get('app');//returns array('db' => array('host' => 'localhost', 'host2' => 'localhost'));
 * $this->delete('app.db.host2');
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

class DataContainer implements NatalPHPObject {
    protected $data = array();
    

    function __construct(array &$initialData = array(), $keepReference = false) {
        $this->setData($initialData, $keepReference);
    }

    function setData(&$data, $keepReference = false) {
        if (!$keepReference)
            $this->data = $data;
        else
           $this->data  = &$data;        
    }

    function set($var, $value) {
        $this->data =  $this->_set($var, $value, $this->data);
    }

    function has($var) {
        return $this->_has($var, $this->data);
    }

    function get($var = null, $defaultValue = null) {
        if ($var === null)
            return $this->getAll();
        return $this->_get($var, $this->data, $defaultValue);
    }

    function delete($var) {
       $this->data = $this->_delete($var, $this->data);
    }

    function getAll() {
        return $this->data;
    }
    
    function clear() {
        $this->data = array();
    }

    private function _delete($var, $data) {
        $parts = explode('.', $var);
        $vars  = $this->data;
        $totalParts = count($parts);

        if ($totalParts == 1) {
            unset($data[$parts[0]]);
            return $data;
        } else {
            $part = array_shift($parts);
            if (!isset($data[$part]))
                return false;
            $data[$part] = $this->_delete(implode('.', $parts),$data[$part]);
        }
        return $data;
    }

    private function _get($var, $data, $defaultValue) {
        $parts = explode('.', $var);
        $vars  = $this->data;
        $totalParts = count($parts);

        if ($totalParts == 1) {
            if (!isset($data[$parts[0]]))
                return $defaultValue;
            return $data[$parts[0]];
        } else {
            $part = array_shift($parts);
            if (!isset($data[$part]))
                return $defaultValue;
            return $this->_get(implode('.', $parts), $data[$part], $defaultValue);
        }

    }


    private function _set($var, $value, $data) {
        $parts = explode('.', $var);
        $vars  = $this->data;
        $totalParts = count($parts);

        if ($totalParts == 1) {
            $data[$parts[0]] = $value;
            return $data;
        } else {
            $part = array_shift($parts);
            if (empty($data[$part]) || !is_array($data[$part]))
                $data[$part] = array();
            $data[$part] = $this->_set(implode('.', $parts), $value, $data[$part]);
        }
        return $data;
    }

    private function _has($var, $data) {
        $parts = explode('.', $var);
        $vars  = $this->data;
        $totalParts = count($parts);

        if ($totalParts == 1) {
            return isset($data[$parts[0]]);
        } else {
            $part = array_shift($parts);
            if (!isset($data[$part]))
                return false;
            return $this->_has(implode('.', $parts), $data[$part]);
        }

    }
}
