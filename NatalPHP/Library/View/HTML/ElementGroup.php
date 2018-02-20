<?php
namespace NatalPHP\View\HTML;
/* SVN FILE: $Id: Element.php 98 2010-05-20 12:47:48Z sadjow $ */
/**
 * Element class file.
 * Defines constants of attributes to use in elements.
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
 * @version       $Rev: 98 $
 * @modifiedby    $LastChangedBy: sadjow $
 * @lastmodified  $Date: 2010-05-20 09:47:48 -0300 (qui, 20 mai 2010) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

require_once 'Element.php';

/**
 * Class representing a HTML element.
 * With this class you can build HTML elements, add and remove attributes.
 * Insert internal content, at the beginning or end, or simply define the content.
 *
 * @package       NatalPHP
 * @subpackage    NatalPHP.NatalPHP.View.HTML
 */
class ElementGroup extends Element {

    public function __construct(){
        parent::__construct(null);
    }

    public function __toString(){
        return implode('', $this->beforeElements()) .$this->contentString(). implode('', $this->afterElements());
    }

}
