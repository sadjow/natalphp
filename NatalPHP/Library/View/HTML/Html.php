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

class Html extends Element {

    private $title;

    private $head;

    private $body;


    /**
     * Create new HTML element.
     *
     * @param string $href The hiper reference.
     * @param string $target Where will open the href.
     */
    public function  __construct() {
        parent::__construct('html');        
    }


    /**
     *  Gets or Sets the xmlns value.
     * @param string $value
     * @return Element | string
     */
    public function xmlns($value = null){
        return $this->attr(ATTR_XMLNS, $value);
    }

    /**
     *  Gets or Sets the manifest value.
     * @param string $value
     * @return Element | string
     */
    public function manifest($value = null){
        return $this->attr(ATTR_MANIFEST, $value);
    }

   

}