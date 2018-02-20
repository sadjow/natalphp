<?php
namespace NatalPHP\Util;
require_once __DIR__ . '/DataContainer.php';
require_once __DIR__ . '/NatalPHPSingleton.php';
/* SVN FILE: $Id$ */
/**
 *
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
 * @subpackage    NatalPHP.NatalPHP.Db.Proxies
 * @since         NatalPHP(tm) v 0.1
 * @version       $Rev$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

final class Registry extends NatalPHPSingleton {

    private $dataContainer;

    /**
     * @return Registry
     */
    static function getInstance() {
        return parent::getInstance();
    }

    protected  function __construct(){
        $this->dataContainer = new DataContainer();
    }
    
    function get($var = null, $defaultValue = null) {
        return self::getInstance()->dataContainer->get($var, $defaultValue);
    }
    function getAll() {
        return self::getInstance()->dataContainer->getAll();
    }

    function set($var, $value) {
        self::getInstance()->dataContainer->set($var, $value);
    }

    function has($var) {
        return self::getInstance()->dataContainer->has($var);
    }

    function delete($var) {
        return self::getInstance()->dataContainer->delete($var);
    }
    
    function clear() {
        self::getInstance()->dataContainer->clear();
    }
}

