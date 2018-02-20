<?php
namespace NatalPHP\Util;
/* SVN FILE: $Id: NatalPHPSingleton.php 54 2010-01-11 00:56:26Z Sadjow $ */
/**
 * NatalPhpSingleton class file.
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
 * @subpackage    NatalPHP.NatalPHP.Util
 * @since         NatalPHP(tm) v 0.1
 * @version       $Rev: 54 $
 * @modifiedby    $LastChangedBy: Sadjow $
 * @lastmodified  $Date: 2010-01-10 22:56:26 -0200 (dom, 10 jan 2010) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
require_once(dirname(__DIR__) . '/Base/NatalPHPObject.php');

use NatalPHP\Base;
/**
 * Framework base singleton class.
 * The responsability of this class is to ensure that there is only one instance per subclasse.
 *
 * @package       NatalPHP
 * @subpackage    NatalPHP.NatalPHP.Util
 */
abstract class NatalPHPSingleton implements Base\NatalPHPObject {
    
    /**
     * Rewrite this for initialization code.
     * @access protected
     */
    protected function  __construct(){}

    /**
     * Gets the unique subclass instance.
     * @final
     */
    public static function getInstance(){
        static $instances = array();

        $className = get_called_class();

        if(!isset($instances[$className]))
            $instances[$className] = new $className();

        return $instances[$className];
    }

    /**
     * Do not let the clone of instances.
     * @final
     * @access private
     */
    final private function __clone(){}

}