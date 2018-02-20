<?php
namespace NatalPHP\CommonObjects;

require_once __DIR__ . '/ValueObject.php';

class ObjectWithValidation extends ValueObject {

    const GENDER_MASC = 'm';
    const GENDER_FEMI = 'f';

    private $errors      = array();
    private $validations = array();
    private $labels      = array();
    private $genders     = array();

    function validate() {
        $nomeVars = array_keys($this->validations);
        $return = $this->beforeValidate();
        if ($return === false)
            return false;
        foreach ($nomeVars as $var) {
            $this->validateField($var);
        }
        $this->afterValidate(!$this->hasErrors());
        return !$this->hasErrors();
    }

    function validateField($var) {
        $campoValido = true;
        $validations = $this->getValidation($var);
        $return = $this->beforeFieldValidate($var);
        if ($return === false)
            return false;
        if (!empty($validations)) {
            foreach ($validations as $validacao) {
                $Validacao = $validacao['validation'];
                if (! $this->has($var))
                    $this->{$var} = null;

                if (!$Validacao->validate($this->{$var})) {
                    $campoValido = false;
                    if (!$this->hasError($var)) {
                        $errorMsg = $validacao['errorMsg'];
                        if ($errorMsg === null) {
                            $errorMsg = $Validacao->getDefaultMessage($var,
                                                                      $this->getLabel($var),
                                                                      $this->{$var},
                                                                      $this->getGender($var));
                        }
                        $errorMsg = str_replace('%value%', $this->{$var}, $errorMsg);
                        $errorMsg = str_replace('%label%', $this->getLabel($var), $errorMsg);
                        $this->addError($var, $errorMsg);
                    }
                    break;
                } else {
                    if ($this->hasError($var) && $this->getError($var) == $validacao['errorMsg'])
                        $this->removeError($var);
                }

            }
        }
        $this->afterFieldValidate($var, !$this->hasError($var));
        return !$this->hasError($var);
    }

    function addValidation($var, \NatalPHP\CommonObjects\Validation $validation, $errorMsg = null) {

        if (is_array($var)) {
            foreach ($var as $varName) {
                $tmpErrorMsg = $errorMsg;
                if ($tmpErrorMsg !== null)
                    $tmpErrorMsg = str_replace('%field%', $varName, $tmpErrorMsg);

                $this->addValidation($varName, $validation, $tmpErrorMsg);
            }
            return;
        }
        if ($errorMsg !== null)
            $errorMsg = str_replace('%field%', $var, $errorMsg);
        $this->validations[$var][] = array('validation' => $validation, 'errorMsg' => $errorMsg);
    }

    function getValidations() {
        return $this->validations;
    }

    function getValidation($var) {
        if (empty($this->validations[$var]))
            return array();
        return $this->validations[$var];
    }

    function hasValidation($var) {
        return isset($this->validations[$var]);
    }

    function removeValidation($var) {
        if ($this->hasValidation($var))
            unset($this->validations[$var]);
    }

    function removeValidations() {
        $this->validations = array();
    }

    function removeErrors() {
        $this->errors = array();
    }


    function getErrors() {
        return $this->errors;
    }

    function addError($var, $msgErro) {
        $this->errors[$var] = $msgErro;
    }

    function removeError($var) {
        if ($this->hasError($var))
            unset($this->errors[$var]);
    }

    function hasErrors() {
        return !empty($this->errors);
    }

    function hasError($var) {
        return !empty($this->errors[$var]);
    }

    function getError($var) {
        if (!$this->hasError($var))
            return null;
        return $this->errors[$var];
    }

    function getTotalErrors() {
        return sizeof($this->errors);
    }

    function getValidFields() {
        return array_diff_key($this->getVariaveis(), $this->getErrors());
    }

    function getCountValidFields() {
        return count($this->getValidFields());
    }

    function getInvalidFields() {
        return array_intersect_key($this->getVariaveis(), $this->getErrors());
    }

    function getCountInvalidFields() {
        return count($this->getInvalidFields());
    }

    function setLabel($var, $label, $gender = self::GENDER_MASC) {
        $this->labels[$var]  = $label;
        $this->genders[$var] = $gender;
    }

    function hasLabel($var) {
        return isset($this->labels[$var]);
    }

    function getLabel($var) {
        if ($this->hasLabel($var))
            return $this->labels[$var];
        return $var;
    }

    function setGender($var, $gender) {
        if ($gender != self::GENDER_MASC && $gender != self::GENDER_FEMI)
            $gender = self::GENDER_MASC;
        $this->genders[$var] = $gender;
    }

    function getGender($var) {
        return isset($this->genders[$var]) ? $this->genders[$var] : self::GENDER_MASC;
    }
    
    function getGenders() {
        return $this->genders();
    }
    
    function removeLabel($var) {
        if ($this->hasLabel($var))
            unset($this->labels[$var]);
    }
    
    function removeLabels() {
        $this->labels = array();
    }
    
    /**
     * CallBacks
     */

    function beforeValidate() {

    }
    function afterValidate($success) {

    }
    function beforeFieldValidate($fieldName) {

    }
    function afterFieldValidate($fieldName, $success) {

    }

}
