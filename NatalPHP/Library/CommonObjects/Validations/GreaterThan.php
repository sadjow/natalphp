<?php
namespace NatalPHP\CommonObjects\Validations;

require_once dirname(__DIR__) . '/Validation.php';
class GreaterThan implements \NatalPHP\CommonObjects\Validation  {
	protected $value;
	protected $equals;
	
	function __construct($value, $checkEquals = false){
		$this->value = $value;
		$this->equals = $checkEquals;
	}
	
    function validate($value){
    	if($this->equals)
       	 return $value >= $this->value;
        else 
       	 return $value > $this->value;
    }

    public function getDefaultMessage($var, $label, $value, $gender) {
        $str = $this->equals ? '' : 'or equals to ';
        return "$label must be greater than $str{$this->value}";
    }
}
