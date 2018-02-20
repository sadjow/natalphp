<?php
namespace NatalPHP\View\HTML;
/* SVN FILE: $Id: Comment.php 45 2010-01-10 20:05:40Z Sadjow $ */
/**
 * Comment class file.
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

/**
 * Class representing a HTML comment.
 *
 * "The comment tag is used to insert a comment in the source code.
 * A comment will be ignored by the browser. You can use comments to explain your code,
 * which can help you when you edit the source code at a later date.
 * You can also store program-specific information inside comments.
 * In this case they will not be visible for the user,
 * but they are still available to the program.
 * A good practice is to comment the text inside scripts and style elements to prevent older browsers,
 *  that do not support scripting or styles, from showing it as plain text." (www.w3schools.com)
 *
 * @package       NatalPHP
 * @subpackage    NatalPHP.NatalPHP.View.HTML
 */
class Comment {

    /**
     * The comment.
     * @var string
     */
    private $text;

    /**
     * Create a new HTML comment.
     * @param string $text
     */
    public function __construct($text){
        $this->text = $text;
    }

    /**
     * Returns the HTML comment string.
     * @return string
     */
    public function __toString(){
        return "<!-- {$this->text} -->";
    }
    
}
