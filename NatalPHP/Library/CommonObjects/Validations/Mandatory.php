<?php
namespace NatalPHP\CommonObjects\Validations;

require_once dirname(__DIR__) . '/Validation.php';
class Mandatory implements \NatalPHP\CommonObjects\Validation {

    function validate($value){
        if(is_array($value))
            return !empty($value);
        else{
        	$value = trim($value);
            $value = $value.'';
            return strlen($value) > 0;
        }
    }
    public function getDefaultMessage($var, $label, $value, $gender) {
        return "The $label cannot be empty";
    }
}
