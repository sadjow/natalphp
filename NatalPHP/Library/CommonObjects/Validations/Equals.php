<?php
namespace NatalPHP\CommonObjects\Validations;

require_once dirname(__DIR__) . '/Validation.php';
class Equals implements \NatalPHP\CommonObjects\Validation  {
    protected $value;

    function __construct($value) {
        $this->value = $value;
    }

    function validate($value) {
        return $value == $this->value;
    }

    public function getDefaultMessage($var, $label, $value, $gender) {
        return "$label must be equals to {$this->value}";
    }
}
