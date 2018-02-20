<?php
namespace NatalPHP\View\HTML;
/* SVN FILE: $Id: A.php 45 2010-01-10 20:05:40Z Sadjow $ */
/**
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
 * @subpackage    NatalPHP.NatalPHP.View.HTML
 * @since         NatalPHP(tm) v 0.1
 * @version       $Rev: 45 $
 * @modifiedby    $LastChangedBy: Sadjow $
 * @lastmodified  $Date: 2010-01-10 17:05:40 -0300 (dom, 10 jan 2010) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

require_once('Element.php');

class Script extends Element {

    /**
     * Create a new Script tag.
     */
    public function  __construct($type = null, $src = null, $content = null) {
        parent::__construct('script');

        $this->type($type);
        $this->src($src);
        $this->content($content);
        
    }

    /**
     * Defines the type attribute.
     * @return Link|String
     */
    public function type($value = null){
        return $this->attr(ATTR_TYPE, $value);
    }

    /**
     * Defines the async attribute.
     * @return Link|String
     */
    public function async($value = null){
        return $this->attr(ATTR_ASYNC, $value);
    }

    /**
     * Verify the async attribute, or add or remove it.
     *
     * @param bool $bool
     * @return bool|Script
     */
    public function isAsync($bool = null){
        if($bool === null)
            return $this->hasAttr(ATTR_ASYNC);
        else{
            if($bool)
                return $this->async('async');
            else
                return $this->rattr(ATTR_ASYNC);
        }
    }

    /**
     * Defines the defer attribute.
     * @return Link|String
     */
    public function defer($value = null){
        return $this->attr(ATTR_DEFER, $value);
    }

    /**
     * Defines the src attribute.
     * @return Link|String
     */
    public function src($value = null){
        return $this->attr(ATTR_SRC, $value);
    }

    public static function Create($file){
        
    }

}