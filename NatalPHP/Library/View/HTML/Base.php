<?php
namespace NatalPHP\View\HTML;
/* SVN FILE: $Id: Base.php 45 2010-01-10 20:05:40Z Sadjow $ */
/**
 * Base class file.
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
 * Class representing a Base element.
 *
 * "The <base> tag specifies a default URL, and/or a default target,
 * for all elements with a URL (hyperlinks, images, forms, etc.).
 * The <base> tag must go inside the head element." (www.w3schools.com)
 *
 *
 * @package       NatalPHP
 * @subpackage    NatalPHP.NatalPHP.View.HTML
 */
class Base extends Element {

    /**
     * Create a new base.
     * @param string $href Specifies the URL to use as the base URL for links in the page
     * @param string $target Where to open all the links on the page.
     * This attribute can be overridden by using the target attribute in each link.
     */
    public function __construct($href, $target){
        parent::__construct('base');

        $this->isEmpty(true);
        $this->href($href);
        $this->target($target);
    }

    /**
     * Specifies the URL to use as the base URL for links in the page
     *
     * @param string $href Specifies the URL to use as the base URL for links in the page
     */
    public function href($href){
        $this->attr(ATTR_HREF, $href);
        return $this;
    }

    /**
     * Where to open all the links on the page.
     * This attribute can be overridden by using the target attribute in each link.
     *
     * @param string $target The target of link. The window name that will open the new document.
     */
    public function target($target){
        $this->attr(ATTR_TARGET, $target);
        return $this;
    }
    
}