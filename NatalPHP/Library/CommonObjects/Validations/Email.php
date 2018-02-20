<?php
namespace NatalPHP\CommonObjects\Validations;

require_once dirname(__DIR__) . '/Validation.php';
class Email implements \NatalPHP\CommonObjects\Validation  {

    function validate($value) {
        $value = trim($value);
        $regex = '^[a-zA-Z][a-z0-9A-Z._-]*@[a-zA-Z0-9_-]+\\.[a-zA-Z0-9]{2,4}(\\.[a-zA-Z0-9]{2,4})?$';
        return (boolean)ereg($regex,trim($value));
    }

    public function getDefaultMessage($var, $label, $value, $gender) {
        return "'$value' is an invalid email address";
    }
}
