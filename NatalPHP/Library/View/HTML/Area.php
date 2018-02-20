<?php
namespace NatalPHP\View\HTML;
/* SVN FILE: $Id: Area.php 45 2010-01-10 20:05:40Z Sadjow $ */
/**
 * Area class file.
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
 * @lastmodified  $Date: 2010-01-10 20:05:40 +0000 (Sun, 10 Jan 2010) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

require_once('Element.php');

/**
 * Class representing an Area element.
 *
 * "The <area> tag defines an area inside an image-map (an image-map is an image with clickable areas).
 * The area element is always nested inside a <map> tag." (www.w3schools.com)
 *
 * @package       NatalPHP
 * @subpackage    NatalPHP.NatalPHP.View.HTML
 */
class Area extends Element {
    
    /**
     *
     * @param string $shape rect, rectangle, circ, circle, poly or polygon
     * @param string $coords
     * if shape="rect" then
     * coords="left,top,right,bottom"
     * if shape="circ" then
     * coords="centerx,centery,radius"
     * if shape="poly" then
     * coords="x1,y1,x2,y2,..,xn,yn".
     *
     * @param string $href The hiper reference.
     * @param string $alt Alternative text.
     */
    public function  __construct($shape, $coords, $href, $alt = null) {
        parent::__construct('area');

        $this->isEmpty(true);
        
        $this->shape($shape);
        $this->coords($coords);
        $this->href($href);
        $this->alt($alt);
    }

    /**
     * Sets or returns the shape attribute.
     * @param string $value  rect, rectangle, circ, circle, poly or polygon
     * @return mixed Null if no has shape, and Element if setting the shape.
     */
    public function shape($value = null){
        return $this->attr(ATTR_SHAPE, $value);
    }

    /**
     * Sets or gets the coords
     * @param string $value
     * @return mixed NUll if no has coords or Elements if setting the coords.
     */
    public function coords($value = null){
        return $this->attr(ATTR_COORDS, $value);
    }

    /**
     * Sets or gets the href.
     * @param string $value
     * @return mixed NUll if no has href or Elements if setting the href.
     */
    public function href($value = null){
        return $this->attr(ATTR_HREF, $value);
    }

    /**
     * Sets or gets the alt.
     * @param string $value
     * @return mixed NUll if no has alt or Elements if setting the alt.
     */
    public function alt($value = null){
        return $this->attr(ATTR_ALT, $value);
    }



    
    
}
