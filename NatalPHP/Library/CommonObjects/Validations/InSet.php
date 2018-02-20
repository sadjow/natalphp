<?php
namespace NatalPHP\CommonObjects\Validations;

require_once dirname(__DIR__) . '/Validation.php';
class InSet implements \NatalPHP\CommonObjects\Validation  {
    protected $set = array();

    function __construct(array $set) {
        $this->set = $set;
    }

    function validate($value) {
        return \in_array($value,$this->set);
    }

    public function getDefaultMessage($var, $label, $value, $gender) {
        return "$label must be one of these values: " . implode(', ', $this->set);
    }


}
