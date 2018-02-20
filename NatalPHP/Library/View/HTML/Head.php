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

require_once 'Element.php';
require_once 'ElementGroup.php';
require_once 'CssLink.php';
require_once 'JsScript.php';

class Head extends Element {

    /**
     *
     * @var Element
     */
    protected $titleElement;

    /**
     *
     * @var ElementGroup
     */
    protected $metaElements;

    /**
     *
     * @var ElementGroup
     */
    protected $linkElements;
    
    /**
     *
     * @var ElementGroup
     */
    protected $scriptElements;
    

    public function  __construct($textOfTitle = '') {
        parent::__construct('head');

        $this->titleElement = new Title($textOfTitle);

        $this->metaElements     = new ElementGroup();
        $this->linkElements     = new ElementGroup();
        $this->scriptElements   = new ElementGroup();
        
        $this->append($this->metaElements)
                ->append($this->titleElement)
                ->append($this->linkElements)
                ->append($this->scriptElements);
        
    }
    
    public function title($value = null){
        return $this->titleElement()->content($value);
    }

    
    public function meta($value){
        if($value != null)
            $this->metaElements->append($value);
        
         return $this;
    }

    public function rMeta($value){
        $this->metaElements->rcontent($value);
        
        return $this;
    }

    public function titleElement($value = null) {
        return $this->__callProperty('titleElement', $value);
    }

    public function metaElements($value = null) {
        return $this->__callProperty('metaElements', $value);
    }

    public function linkElements($value = null) {
        return $this->__callProperty('linkElements', $value);
    }

    public function scriptElements($value = null) {
        return $this->__callProperty('scriptElements', $value);
    }

    public function js($value){
       if(is_array($value)){
            foreach($value as $src){
                if(is_string($src))
                    $this->scriptElements()->append(new JsScript($src));
                else
                    $this->scriptElements()->append($src);
            }
        } else {
            if(is_string($value))
                $this->scriptElements()->append(new JsScript($value));
            else
                $this->scriptElements()->append($src);
        }
        return $this;
    }

    public function css($value, $media = null){
        if(is_array($value)){
            foreach($value as $src){
                if(is_string($src))
                    $this->linkElements()->append(new CssLink($src, $media));
                else
                    $this->linkElements()->append($src);
            }
        } else {
            if(is_string($value))
                $this->linkElements()->append(new CssLink($value, $media));
            else
                $this->linkElements()->append($src);
        }
        return $this;
    }

}