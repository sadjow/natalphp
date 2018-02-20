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

class Sluggable extends Behavior {

    private $source;
    private $target;
    

    function __construct($sourceColumn, $targetColumn) {
        $this->source = $sourceColumn;
        $this->target = $targetColumn;       
    }

    function beforeInsert(&$model) {
        $model->{$this->target} = $this->slug($model->{$this->source});
    }

    function slug($str) {
        $escaped = htmlentities(utf8_decode($str), \ENT_COMPAT);
        $regex   = array('#&([aeiou])(grave|acute|circ|tilde|uml|slash);#is', '#&(c)cedil;#is', '#&(a)elig;#is');
        $escaped = trim(preg_replace($regex, array('$1', '$1', '$1'), $escaped));
        $escaped = preg_replace('#[^a-z0-9_ -]#is', '', $escaped);
        $escaped = preg_replace('# +#', '-', $escaped);
        
        return strtolower($escaped);
    }

}

