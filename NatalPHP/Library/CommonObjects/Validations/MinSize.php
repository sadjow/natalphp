<?php
namespace NatalPHP\CommonObjects\Validations;

require_once dirname(__DIR__) . '/Validation.php';
class MinSize implements \NatalPHP\CommonObjects\Validation  {
    protected $min;
    function __construct($minSize) {
        $this->min = $minSize;
    }

    function validate($value) {
        return strlen($value) >= $this->min;
    }

    public function getDefaultMessage($var, $label, $value, $gender) {
        return "$label must have lenght greater then or equals to {$this->min}";
    }
}
