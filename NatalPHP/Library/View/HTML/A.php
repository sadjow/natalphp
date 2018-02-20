<?php
namespace NatalPHP\View\HTML;
/* SVN FILE: $Id: A.php 104 2010-05-20 18:38:34Z sadjow $ */
/**
 * A class file.
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
 * @version       $Rev: 104 $
 * @modifiedby    $LastChangedBy: sadjow $
 * @lastmodified  $Date: 2010-05-20 18:38:34 +0000 (Thu, 20 May 2010) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

require_once('Element.php');

/**
 * Class representing a A element, a anchor.
 * 
 * "The <a> tag defines a hyperlink, which is used to link from one page to another.
 * The most important attribute of the a element is the href attribute,
 * which indicates the link’s destination." (www.w3schools.com)
 * 
 * @package       NatalPHP
 * @subpackage    NatalPHP.NatalPHP.View.HTML
 */
class A extends Element {

    /**
     * Create a new Anchor.
     *
     * @param string $href The hiper reference.
     * @param string $target Where will open the href.
     */
    public function  __construct($href = null, $target = null) {
        parent::__construct('a');

        if($href) $this->href($href);
        if($target) $this->target($target);
    }

    /**
     * Sets the href of link.
     *
     * @param string $value The hiper reference in internet. An Address.
     */
    public function href($value = null){
        return $this->attr(ATTR_HREF, $value);
    }

    /**
     * Sets the target of link.
     *
     * @param string $value The target of link. The window name that will open the new document.
     */
    public function target($value = null){
        return $this->attr(ATTR_TARGET, $value);
    }

}
