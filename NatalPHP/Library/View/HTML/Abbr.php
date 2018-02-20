<?php
namespace NatalPHP\View\HTML;
/* SVN FILE: $Id: Abbr.php 45 2010-01-10 20:05:40Z Sadjow $ */
/**
 * Abbr class file.
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
 * Class representing an Abbr element, an abbreviation.
 *
 * "The <abbr> tag indicates an abbrevation or an acronym, like "WWW" or "NATO".
 * By marking up abbreviations you can give useful information to browsers, spell checkers,
 * translation systems and search-engine indexers." (www.w3schools.com)
 *
 * @package       NatalPHP
 * @subpackage    NatalPHP.NatalPHP.View.HTML
 */
class Abbr extends Element {
    
    /**
     * Create a new abbreviation.
     *
     * @param string $content The abbreviation.
     * @param string $title The meaning of the abbreviation.
     */
    public function  __construct($content, $title = null) {
        parent::__construct('abbr');

        $this->content($content);
        if($title) $this->title($title);
    }
    
}
