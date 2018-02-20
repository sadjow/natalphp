<?php
namespace NatalPHP\CommonObjects;
use NatalPHP\Base\NatalPHPObject;
require_once dirname(__DIR__) . '/Base/NatalPHPObject.php';
interface Validation extends NatalPHPObject {

    function validate($value);
    function getDefaultMessage($var, $label, $value, $gender);
    
}

