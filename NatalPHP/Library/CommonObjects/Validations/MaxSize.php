<?php
namespace NatalPHP\CommonObjects\Validations;

require_once dirname(__DIR__) . '/Validation.php';
class MaxSize implements \NatalPHP\CommonObjects\Validation  {
    protected $max;
    function __construct($max){
            $this->max = $max;
    }
    
    function validate($value){
        return strlen($value) <= $this->max;
    }

    public function getDefaultMessage($var, $label, $value, $gender) {
        return "$label must have lenght less then or equals to {$this->max}";
    }
}
