<?php
namespace NatalPHP\CommonObjects\Validations;

require_once dirname(__DIR__) . '/Validation.php';
class Inteiro implements \NatalPHP\CommonObjects\Validation  {
	
    function validate($value) {
    	return (filter_var($value,FILTER_VALIDATE_INT) !== false);
    }

    public function getDefaultMessage($var, $label, $value, $gender) {
        return "$label must be a valid integer number";
    }
}
