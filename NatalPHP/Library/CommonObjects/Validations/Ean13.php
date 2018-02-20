<?php
namespace NatalPHP\CommonObjects\Validations;

require_once dirname(__DIR__) . '/Validation.php';

class Ean13 implements \NatalPHP\CommonObjects\Validation  {

    function validate($value) {

        $valueString = (string) $value;

        if (strlen($valueString) !== 13) {
            return false;
        }

        $barcode = strrev(substr($valueString, 0, -1));
        $oddSum  = 0;
        $evenSum = 0;

        for ($i = 0; $i < 12; $i++) {
            if ($i % 2 === 0) {
                $oddSum += $barcode[$i] * 3;
            } elseif ($i % 2 === 1) {
                $evenSum += $barcode[$i];
            }
        }

        $calculation = ($oddSum + $evenSum) % 10;
        $checksum    = ($calculation === 0) ? 0 : 10 - $calculation;

        if ($valueString[12] != $checksum) {
            return false;
        }

        return true;
    }

    public function getDefaultMessage($var, $label, $value, $gender) {
        return "'$value' is an invalid EAN-13 code";
    }


}
