<?php
namespace NatalPHP\CommonObjects\Validations;

require_once dirname(__DIR__) . '/Validation.php';
class SizeEquals implements \NatalPHP\CommonObjects\Validation  {
    protected $size;
	
    function __construct($size){
            $this->size = $size;
    }
    function validate($value){
        return strlen($value) == $this->size;
    }

    public function getDefaultMessage($var, $label, $value, $gender) {
        return "$label must be lenght equals to {$this->size}";
    }
}
