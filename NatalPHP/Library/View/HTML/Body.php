<?php
namespace NatalPHP\View\HTML;
/* SVN FILE: $Id: Body.php 93 2010-04-19 00:03:12Z Sadjow $ */
/**
 * Body class file.
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
 * @version       $Rev: 93 $
 * @modifiedby    $LastChangedBy: Sadjow $
 * @lastmodified  $Date: 2010-04-19 00:03:12 +0000 (Mon, 19 Apr 2010) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

require_once('Element.php');

/**
 * Class representing a Body element.
 *
 * "The <body> tag defines the document's body.
 * The <body> element contains all the contents of an HTML document, such as text,
 * hyperlinks, images, tables, lists, etc." (www.w3schools.com)
 *
 *
 * @package       NatalPHP
 * @subpackage    NatalPHP.NatalPHP.View.HTML
 */
class Body extends Element {

    /**
     * Create a new Body element.
     * @param string $content The content
     */
    public function __construct($content = null){
        parent::__construct('body');

        $this->content($content);
    }

}