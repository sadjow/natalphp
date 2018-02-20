<?php
namespace NatalPHP\View\HTML;
/* SVN FILE: $Id: Bdo.php 45 2010-01-10 20:05:40Z Sadjow $ */
/**
 * Bdo class file.
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
 * Class representing a Bdo element.
 *
 * "bdo stands for bidirectional override.
 * The <bdo> tag allows you to specify the text direction and
 * override the bidirectional algorithm." (www.w3schools.com)
 *
 *
 * @package       NatalPHP
 * @subpackage    NatalPHP.NatalPHP.View.HTML
 */
class Bdo extends Element {

    /**
     * Create a new bdo element.
     * @param string $dir Defines the text direction. This attribute is required
     * @param string $content The content
     */
    public function __construct($dir, $content){
        parent::__construct('base');

        $this->dir($dir);
        $this->content($content);
    }

    /**
     * Defines the text direction. This attribute is required
     *
     * @param string $value ltr or rtl
     */
    public function dir($value){
        $this->attr(ATTR_DIR, $value);
        return $this;
    }
    
}