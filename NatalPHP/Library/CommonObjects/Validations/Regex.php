<?php
namespace NatalPHP\CommonObjects\Validations;

require_once dirname(__DIR__) . '/Validation.php';
class Regex implements \NatalPHP\CommonObjects\Validation  {
    private $regex;

    
    function __construct($regex){   
    	 $this->regex = $regex;            
    }
    
    function validate($value){
        return preg_match($this->regex,$value);
    }

    public function getDefaultMessage($var, $label, $value, $gender) {
        return "'$value' not matches with $label pattern";
    }
}
