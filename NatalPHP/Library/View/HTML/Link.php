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

class Link extends Element {

    /**
     * Create a new Link tag.
     */
    public function  __construct($rel = null, $type = null, $href = null, $media = null) {
        parent::__construct('link', true);

        $this->rel($rel);
        $this->type($type);
        $this->href($href);
        $this->media($media);
        
    }

    /**
     * Defines the type attribute.
     * @return Link|String
     */
    public function type($value = null){
        return $this->attr(ATTR_TYPE, $value);
    }

    /**
     * Defines the rel
     * @return Link|String
     */
    public function rel($value = null){
        return $this->attr(ATTR_REL, $value);
    }

    /**
     * Defines the href attribute.
     * @return Link|String
     */
    public function href($value = null){
        return $this->attr(ATTR_HREF, $value);
    }

    /**
     * Defines the hreflang attribute.
     * @return Link|String
     */
    public function hreflang($value = null){
        return $this->attr(ATTR_HREFLANG, $value);
    }

    /**
     * Defines the media attribute.
     * @return Link|String
     */
    public function media($value = null){
        return $this->attr(ATTR_MEDIA, $value);
    }

    /**
     * Defines the sizes attribute.
     * @return Link|String
     */
    public function sizes($value = null){
        return $this->attr(ATTR_SIZES, $value);
    }
    
}