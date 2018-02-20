<?php
namespace NatalPHP\Db\Objects\ModelBehaviors;
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

abstract class Behavior {
    private $enabled = true;

    function enable() {
        $this->enabled = true;
    }

    function disable() {
        $this->enabled = false;
    }

    function enabled() {
        return $this->enabled;
    }
    
    function toggleEnabled() {
        $this->enabled = !$this->enabled;
    }


    function beforeSave(&$model) {}
    function afterSave(&$model, $success) {}
    function beforeInsert(&$model) {}
    function afterInsert(&$model, $success) {}
    function beforeDelete(&$model) {}
    function afterDelete(&$model, $success) {}
    function beforeFill(&$model, $data) {}
    function afterFill(&$model, $success) {}
    function beforeUpdate(&$model){}
    function afterUpdate(&$model, $success) {}

}


