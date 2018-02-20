<?php
namespace NatalPHP\CommonObjects\Validations;
require_once dirname(__DIR__) . '/Validation.php';

class AcceptNull implements \NatalPHP\CommonObjects\Validation  {
    private $validation;

    function __construct(\NatalPHP\CommonObjects\Validation $validation) {
        $this->validation = $validation;
    }

    function validate($value) {
        if (is_null($value))
            return true;
        return $this->validation->validate($value);
    }

    public function getDefaultMessage($var, $label, $value, $gender) {
        return $this->validation->getDefaultMessage($var, $label, $value, $gender);
    }
}
