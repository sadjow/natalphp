<?php
namespace NatalPHP\View\HTML;
/* SVN FILE: $Id: Address.php 45 2010-01-10 20:05:40Z Sadjow $ */
/**
 * Address class file.
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
 * Class representing an Address element, the address.
 *
 * "The <address> tag defines the contact information for the author or owner of a document.
 * If the <address> element is inside an <article> element,
 * it represents the contact information of the author/owner of that article." (www.w3schools.com)
 *
 * @package       NatalPHP
 * @subpackage    NatalPHP.NatalPHP.View.HTML
 */
class Address extends Element {
    
    /**
     * Create a new address.
     *
     * @param string $content The address.
     */
    public function  __construct($content) {
        parent::__construct('address');

        $this->content($content);
    }
    
}
