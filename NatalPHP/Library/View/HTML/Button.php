<?php
namespace NatalPHP\View\HTML;
/* SVN FILE: $Id: Button.php 45 2010-01-10 20:05:40Z Sadjow $ */
/**
 * Button class file.
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
 * Class representing a Button element.
 *
 * "The <button> tag defines a push button.
 * Inside a button element you can put content, like text or images.
 * This is the difference between this element and buttons created with the input element.
 * Always specify the type attribute for the button. Different browsers uses different
 * default values for the type attribute." (www.w3schools.com)
 * 
 * e.g : <button type="button">Click Me!</button>
 *
 * @package       NatalPHP
 * @subpackage    NatalPHP.NatalPHP.View.HTML
 */
class Button extends Element {

    /**
     * Create a new Button element.
     * Note: if you use the button element in an HTML form,
     * different browsers submit different button values.
     * Use the input element to create buttons in an HTML form.
     * 
     * @param string $content The content
     * @param string $type Defines the type of button (button, reset or submit )
     */
    public function __construct($content, $type = 'button'){
        parent::__construct('button');

        $this->content($content);
        $this->type($type);
    }

    /**
     * Defines the type of button
     *
     * @param string $href Specifies the URL to use as the base URL for links in the page
     * @return mixed null if not defined, string if defined, Element if setting.
     */
    public function type($value){
        $this->attr(ATTR_TYPE, $href);
        return $this;
    }

}