<?php
/* SVN FILE: $Id: consts.php 99 2010-05-20 15:41:54Z sadjow $ */
/**
 * Start file.
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
 * @package       App
 * @since         NatalPHP(tm) v 0.1
 * @version       $Rev: 98 $
 * @modifiedby    $LastChangedBy: sadjow $
 * @lastmodified  $Date: 2010-05-20 09:47:48 -0300 (qui, 20 mai 2010) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

//constantes
define("DS",DIRECTORY_SEPARATOR);

// Root
define("ROOT",dirname(dirname(__FILE__)).DS);
define("RELATIVE_ROOT",str_replace("\\","/",str_replace(realpath($_SERVER['DOCUMENT_ROOT']),"",ROOT)));

// Content
define("CONTENT",ROOT."content".DS);
define("RELATIVE_CONTENT",RELATIVE_ROOT."content/");

// Layout
define("LAYOUT",ROOT."layouts".DS);

// Images
define("IMG",CONTENT."img".DS);
define("RELATIVE_IMG",RELATIVE_CONTENT."img/");

// JavaScript
define("JS",CONTENT."js".DS);
define("RELATIVE_JS",RELATIVE_CONTENT."js/");

// CSS
define("CSS",CONTENT."css".DS);
define("RELATIVE_CSS",RELATIVE_CONTENT."css/");

//Files
define("FILES",CONTENT."files".DS);
define("RELATOVE_FILES",RELATIVE_CONTENT."files/");

// Domain
define('DOMAIN', $_SERVER['HTTP_HOST']);
define('RELATIVE_DOMAIN', DOMAIN.RELATIVE_ROOT);


// CONTROL
define('FILE_CONTROLLER', 'controller.php');

// AUTOLOADER File
define('FILE_AUTOLOADER', dirname(ROOT) .DS .'NatalPHP'.DS.'Library'.DS.'Util'.DS.'Autoloader.php') ;

define('LIBRARY_PATH', dirname(ROOT) .DS . 'NatalPHP'.DS.'Library'.DS);