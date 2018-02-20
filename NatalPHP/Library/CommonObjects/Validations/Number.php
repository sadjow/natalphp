<?php
namespace NatalPHP\CommonObjects\Validations;

require_once dirname(__DIR__) . '/Validation.php';

class Number implements \NatalPHP\CommonObjects\Validation  {
	
    function validate($value){
        return is_numeric($value);
    }

    public function getDefaultMessage($var, $label, $value, $gender) {
        return "$label must be a valid number";
    }
}
