<?php
/* SVN FILE: $Id: config.php 99 2010-05-20 15:41:54Z sadjow $ */
/**
 * Configuration file.
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


// Error level
error_reporting(E_ALL | E_STRICT);

set_error_handler("testErro", E_ALL | E_STRICT);

function testErro($u, $d, $t, $q){
    echo "<p>";
    echo "Erro numero: <b>". $u ."</b><br/ >";
    echo "Mensagem: <b>". $d ."</b><br/ >";
    echo "Arquivo: <b>". $t ."</b><br/ >";
    echo "Linha: <b>". $q ."</b><br/ >";
    echo "</p>";
}

require_once __DIR__ . '/consts.php';