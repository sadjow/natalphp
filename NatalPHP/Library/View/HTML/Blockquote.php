<?php
namespace NatalPHP\View\HTML;
/* SVN FILE: $Id: Blockquote.php 45 2010-01-10 20:05:40Z Sadjow $ */
/**
 * Blockquote class file.
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
 * Class representing a Blockquote element.
 *
 * "The <blockquote> tag defines a block of quotation that is taken from another source.
 * Browsers usually renders the text from <blockquote> elements with paragraph breaks." (www.w3schools.com)
 *
 *
 * @package       NatalPHP
 * @subpackage    NatalPHP.NatalPHP.View.HTML
 */
class Blockquote extends Element {

    /**
     * Create a new Blockquote element.
     * @param string $cite URL of the quote, if it is taken from the web
     * @param string $content The content
     */
    public function __construct($cite, $content){
        parent::__construct('blockquote');

        $this->cite($cite);
        $this->content($content);
    }

    /**
     * Sets or gets the cite.
     *
     * @param string $value URL of the article, if it is taken from the web
     * @return mixed Null if no has cite, and Element if setting the cite.
     */
    public function cite($value = null){
        return $this->attr(ATTR_CITE, $value);
    }
    
}