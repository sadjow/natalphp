<?php
namespace NatalPHP\Db\Objects\ModelBehaviors;
require_once __DIR__ . '/Behavior.php';
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

class Timestampable extends Behavior{
    private $createdField;
    private $updatedField;
    
    private $createdFormat  = 'Y-m-d H:i:s';
    private $updatedFormat = 'Y-m-d H:i:s';

    function __construct($createdField, $updatedField) {
        $this->createdField = $createdField;
        $this->updatedField = $updatedField;
    }

    function setCreatedFormat(&$model, $format) {
        $this->createdFormat = $format;
    }

    function setUpdatedFormat(&$model, $format) {
        $this->updatedFormat = $format;
    }


    function beforeUpdate(&$model) {
        if ($this->updatedField !== null)
            $model->{$this->updatedField} = date($this->updatedFormat);
    }
    
    function beforeInsert(&$model) {
        if ($this->createdField !== null)
            $model->{$this->createdField} = date($this->createdFormat);
    }

  
}


