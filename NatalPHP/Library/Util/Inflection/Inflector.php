<?php
namespace NatalPHP\Util\Inflection;
/* SVN FILE: $Id: Inflector.php 53 2010-01-10 23:12:21Z Sadjow $ */
/**
 * Inflector class file.
 *
 * NatalPHP (tm) :  Sufficient and Simple Framework (http://www.trycatch.com.br)
 * Copyright 2010 Sadjow Medeiros Leão <sadjow[at]gmail.com>,
 * Waldson Patricio <waldsonpatricio[at]gmail.com
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2010 Sadjow Medeiros Leão <sadjow[at]gmail.com>,
 *                Waldson Patricio <waldsonpatricio[at]gmail.com
 * @link          http://www.trycatch.com.br Natal(tm) Project
 * @package       NatalPHP
 * @subpackage    NatalPHP.NatalPHP.Util.Inflection
 * @since         NatalPHP(tm) v 0.1
 * @version       $Rev: 53 $
 * @modifiedby    $LastChangedBy: Sadjow $
 * @lastmodified  $Date: 2010-01-10 21:12:21 -0200 (dom, 10 jan 2010) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/Util/NatalPhpSingleton.php' );
require_once __DIR__ . '/PTBRRules.php';
use NatalPHP\Util;
use NatalPHP\Util\Inflection;
/**
 * Class Inflector
 * @package NatalPHP
 * @package NatalPHP.NatalPHP.Util.Inflection
 */
class Inflector extends Util\NatalPHPSingleton {

    /**
     * Rules instance.
     * @var InflectorRules
     */
    private $rules;

    /**
     * Sigularized words
     * @var array
     */
    private $singularized = array();

    /**
     * Pluralized words
     * @var pluralized
     */
    private $pluralized = array();

    /**
     * Overrides the singleton construct method.
     */
    protected function __construct(){
        $this->__initDefaultRules();
        parent::__construct();
    }

    /**
     * Sets the rules for inflections.
     * @param InflectorRules $rules Rules for Inflector
     */
    public static function setRules($rules){
        $_this = & Inflector::getInstance();

        $_this->rules = $rules;
    }

    /**
     * Initialize the default rules.
     */
    private function __initDefaultRules(){
        $this->rules = new PTBRRules();
    }

    /**
     * Pluralize the singularized word.
     * @param string $word
     * @return string
     */
    public static function pluralize($word){
        $_this = & Inflector::getInstance();

        if(isset($_this->pluralized[$word])){
            return $_this->pluralized[$word];
        }
        
        $regexUninflected = Inflector::__enclose(implode('|', $_this->rules->getUninflected()));
        $regexIrregular = Inflector::__enclose(implode('|', $_this->rules->getIrregularPrural()));


        if (preg_match('/^(' . $regexUninflected . ')$/i', $word, $regs)) {
            $_this->pluralized[$word] = $word;
            return $word;
        }

        if (preg_match('/(.*)\\b(' . $regexIrregular . ')$/i', $word, $regs)) {
            $_this->pluralized[$word] = $regs[1] . substr($word, 0, 1) . substr($irregular[strtolower($regs[2])], 1);
            return $_this->pluralized[$word];
        }

        foreach ($_this->rules->getPruralRules() as $rule => $replacement) {
            if (preg_match($rule, $word)) {
                $_this->pluralized[$word] = preg_replace($rule, $replacement, $word);
                return $_this->pluralized[$word];
            }
        }
        
        $_this->pluralized[$word] = $word;
        return $word;
    }

    /**
     * Singularize the pluralized word.
     * @param string $word
     * @return string
     */
    public static function singularize($word){
        $_this = & Inflector::getInstance();


        if(isset($_this->singularized[$word])){
            return $_this->singularized[$word];
        }

        $regexUninflected = Inflector::__enclose(implode('|',$_this->rules->getUninflected()));
        $regexIrregular =   Inflector::__enclose(implode('|', $_this->rules->getIrregularSingular()));
        
        if (preg_match('/^(' . $regexUninflected . ')$/i', $word, $regs)) {
            $_this->singularized[$word] = $word;
            return $word;
        }
        
        if (preg_match('/(.*)\\b(' . $regexIrregular . ')$/i', $word, $regs)) {
            $_this->singularized[$word] = $regs[1] . substr($word, 0, 1) . substr($irregular[strtolower($regs[2])], 1);
            return $_this->singularized[$word];
        }

        foreach ($_this->rules->getSingularRules() as $rule => $replacement) {
            if (preg_match($rule, $word)) {
                $_this->singularized[$word] = preg_replace($rule, $replacement, $word);
                return $_this->singularized[$word];
            }
        }
        
        $_this->singularized[$word] = $word;
        return $word;
    }

    /**
     * Returns the table people for class Person
     * @param string $className
     * @return string
     */
    public static function tableize($className) {
        $words = explode('_', Inflector::underscore($className));

        $tableized = '';
        
        foreach($words as $key => $value){
            $plural = Inflector::pluralize($value);
            $tableized .= $plural.'_';
        }
        
        return rtrim($tableized, '_');
    }


    /**
     * Transforms the table_name to a ClassName.
     * @param string $tableName
     * @return string
     */
    public static function classify($tableName) {
        $words = explode('_', $tableName);

        $classified = '';

        foreach($words as $key => $value){
            $singular = Inflector::singularize($value);
            $classified .= Inflector::camelize($singular);
        }
        
        return $classified;
    }

    /**
     * Transforms a camelCaseWord in camel_case_word
     * @param string $camelCasedWord
     * @static
     * @return string
     */
    public static function underscore($camelCasedWord) {
        return strtolower(preg_replace('/(?<=\\w)([A-Z])/', '_\\1', $camelCasedWord));
    }

    /**
     * Transforms a lowercase and underscored word to a camilized word.
     * @param string $lowerCaseAndUnderscoredWord
     * @return string
     */
    public static function camelize($lowerCaseAndUnderscoredWord) {
	return str_replace(" ", "", ucwords(str_replace("_", " ", $lowerCaseAndUnderscoredWord)));
    }

    /**
     * Enclose a string for preg matching.
     *
     * @static
     * @param string $string String to enclose
     * @return string Enclosed string
     */
    private static function __enclose($string) {
            return '(?:' . $string . ')';
    }

}