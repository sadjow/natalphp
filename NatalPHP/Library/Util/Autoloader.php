<?php
namespace NatalPHP\Util;
/* SVN FILE: $Id: Autoloader.php 51 2010-01-10 22:31:30Z Sadjow $ */
/**
 * Connection class file.
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
 * @version       $Rev: 51 $
 * @modifiedby    $LastChangedBy: Sadjow $
 * @lastmodified  $Date: 2010-01-10 22:31:30 +0000 (Sun, 10 Jan 2010) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
require_once dirname(__DIR__) . '/Base/NatalPhpObject.php';

/**
 * Framework Autoload class
 *
 * @package       NatalPHP
 * @subpackage    NatalPHP.NatalPHP.Db.Connection
 */
class Autoloader implements \NatalPhp\Base\NatalPHPObject {

    private static $libraryPath = null;

    static function setLibraryPath($path) {
        self::$libraryPath = $path;
    }

    static function autoload($className) {
        $path      = self::$libraryPath ?: dirname(__DIR__);
        $className = str_replace('\\', '/', $className) . '.php';
        $className = str_replace('NatalPhp/', '', $className);
        $fileName  = $path . '/' . $className;
        require_once($fileName);
    }


    private function __construct() {
        
    }
}

