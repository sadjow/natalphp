<?php
namespace NatalPHP\CommonObjects\Validations\PTBRValidations;

use NatalPHP\CommonObjects\Validations\Mandatory;
require_once dirname(__DIR__) . '/Mandatory.php';
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

class Obrigatorio extends Mandatory {

    public function getDefaultMessage($var, $label, $value, $gender) {
        $artigo = $gender == 'm' ? 'o' : 'a';        
        return strtoupper($artigo) .  " $label deve ser informad" . $artigo;
    }
}

