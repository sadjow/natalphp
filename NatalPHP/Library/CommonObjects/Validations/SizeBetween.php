<?php
namespace NatalPHP\CommonObjects\Validations;

require_once dirname(__DIR__) . '/Validation.php';
class SizeBetween implements \NatalPHP\CommonObjects\Validation  {
    protected $minSize;
    protected $maxSize;
    function __construct($minSize,$maxSize){
            $this->minSize = $minSize;
            $this->maxSize = $maxSize;
    }

    function validate($value){
        return strlen($value) >= $this->minSize && strlen($value) <= $this->maxSize;
    }

    public function getDefaultMessage($var, $label, $value, $gender) {
        return "$label must have lenght between {$this->minSize} and {$this->maxSize}";
    }
}
