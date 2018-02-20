<?php
namespace NatalPHP\CommonObjects\Validations;

require_once dirname(__DIR__) . '/Validation.php';
class NumberBetween implements \NatalPHP\CommonObjects\Validation  {
    protected $min;
    protected $max;

    function __construct($min, $max) {
            $this->min = $min;
            $this->max = $max;
    }

    function validate($value){
         return $value >= $this->min && $value <= $this->max;
    }

    public function getDefaultMessage($var, $label, $value, $gender) {
        return "$label must be between {$this->min} and {$this->max}";
    }
}
