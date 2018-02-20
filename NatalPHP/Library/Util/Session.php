<?php
namespace NatalPHP\Util;
use NatalPHP\Base\NatalPHPObject;

require_once dirname(__DIR__) . '/Base/NatalPHPObject.php';
require_once __DIR__ . '/DataContainer.php';

/* SVN FILE: $Id$ */
/**
 * Helper class for session
 * Class for manipulate session
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

class Session implements NatalPHPObject {
  
    private static $dataContainer;

    /**
     * @return DataContainer
     */
    private static function getContainer() {
        if (!self::start())
            return null;
        if (is_null(self::$dataContainer)) 
            self::$dataContainer = new DataContainer($_SESSION, true);
        
        return self::$dataContainer;
    }

    static function start() {
        if (headers_sent())
            return false;
        if (isset($_SESSION))
            return true;
        session_start();
        return true;
    }

    static function close() {
        if (self::start()) {
            session_write_close();
            return true;
        }
        return false;
    }

    static function destroy() {
        if (self::start()) {
            session_destroy();
            return true;
        }
        return false;
    }

    static function set($var, $value) {
        $container = self::getContainer();
        if ($container === null)
            return false;
        $container->set($var, $value);
        return true;
    }

    static function get($var = null, $defaultValue = null) {
        $container = self::getContainer();
        if ($container === null)
            return null;
        return $container->get($var, $defaultValue);
    }
    static function getAll() {
        $container = self::getContainer();
        if ($container === null)
            return null;
        return $container->getAll();
    }

    static function has($var) {
        $container = self::getContainer();
        if ($container === null)
            return false;
        return $container->has($var);
    }

    static function delete($var) {
        $container = self::getContainer();
        if ($container === null)
            return false;
        return $container->delete($var);
    }

}