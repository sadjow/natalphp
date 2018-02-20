<?php
namespace NatalPHP\CommonObjects;

require_once dirname(dirname(__FILE__)) . '/Base/NatalPHPObject.php';

class ValueObject implements \ArrayAccess, \NatalPHP\Base\NatalPHPObject {
    private $data = array();

    function set($var, $valor) {
        $this->data[$var] = $valor;
    }

    function get($var) {
        if (!$this->has($var))
            return null;
        return $this->data[$var];
    }

    function has($var) {
        return isset($this->data[$var]);
    }

    public function offsetExists($offset) {
        return $this->has($offset);
    }
    public function offsetGet($offset) {
        if ($this->has($offset))
            return $this->data[$offset];
    }
    public function offsetSet($offset, $value) {
        $this->data[$offset] = $value;
    }
    public function offsetUnset($offset) {
        if ($this->has($offset))
            unset($this->data[$offset]);
    }

    function __isset($var) {
        return array_key_exists($var, $this->data);
    }
    function __unset($var) {
        if ($this->has($var))
         unset($this->data[$var]);
    }
    function __set($var, $valor) {
        $this->set($var, $valor);
    }

    function __get($var) {
        return $this->get($var);
    }
    function toArray() {
        return $this->data;
    }

    function fillFromArray(array $data) {
        $this->data = $data;
    }
   
}
