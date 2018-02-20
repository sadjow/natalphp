<?php
namespace NatalPHP\CommonObjects\Validations;

require_once dirname(__DIR__) . '/Validation.php';
class LessThan implements \NatalPHP\CommonObjects\Validation  {
    protected $value;
    protected $equals;

    function __construct($value, $equals = false) {
        $this->value = $value;
        $this->equals = $equals;
    }

    function validate($value) {
        if($this->equals)
            return $value <= $this->value;
        else
            return $value < $this->value;
    }
    public function getDefaultMessage($var, $label, $value, $gender) {
        $str = $this->equals ? '' : 'or equals to ';
        return "$label must be less than $str{$this->value}";
    }
}
