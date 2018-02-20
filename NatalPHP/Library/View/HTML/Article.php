<?php
namespace NatalPHP\View\HTML;
/* SVN FILE: $Id: Article.php 45 2010-01-10 20:05:40Z Sadjow $ */
/**
 * Article class file.
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
 * Class representing an Article element.
 *
 * "The <article> tag defines external content.
 * The external content could be a news-article from an external provider,
 * or a text from a web log (blog), or a text from a forum, or any other content
 * from an external source." (www.w3schools.com)
 *
 * @package       NatalPHP
 * @subpackage    NatalPHP.NatalPHP.View.HTML
 */
class Article extends Element {
    
    /**
     * Create a new Article.
     * @param string $cite URL of the article, if it is taken from the web
     * @param string $pubdate Defines the time and date that the article was first published.
     */
    public function  __construct($cite, $pubdate) {
        parent::__construct('article');
        
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

    /**
     * Sets or get the pubdate.
     * 
     * @param string $value Defines the time and date that the article was first published.
     * @return mixed Null if no has pubdate, and Element if setting the pubdate.
     */
    public function pubdate($value = null){
        return $this->attr(ATTR_PUBDATE, $value);
    }

    
}