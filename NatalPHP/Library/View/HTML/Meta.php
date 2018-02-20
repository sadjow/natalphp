<?php
namespace NatalPHP\View\HTML;
/* SVN FILE: $Id: A.php 45 2010-01-10 20:05:40Z Sadjow $ */
/**
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
 * @lastmodified  $Date: 2010-01-10 17:05:40 -0300 (dom, 10 jan 2010) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

require_once('Element.php');

class Meta extends Element {

    /**
     * Create a new Meta tag.
     */
    public function  __construct() {
        parent::__construct('meta', true);
        
    }

    /**
     * Defines the content attribute.
     * @return Meta|String
     */
    public function contentAttr($value = null){
        return $this->attr(ATTR_CONTENT, $value);
    }

    /**
     * Defines the name
     * @return Meta|String
     */
    public function name($value = null){
        return $this->attr(ATTR_NAME, $value);
    }

    /**
     * Defines the http-equiv
     * @return Meta|String
     */
    public function httpEquiv($value = null){
        return $this->attr(ATTR_HTTP_EQUIV, $value);
    }

    /**
     * Defines the chartset
     * @return Meta|String
     */
    public function charset($value = null){
        return $this->attr(ATTR_CHARSET, $value);
    }

    /**
     * Defines the chartset to utf-8
     * @return Meta
     */
    public function utf8(){
        return $this->charset(CHARSET_UTF8);
    }

    /**
     * Defines the chartset to iso-8859-1
     * @return Meta
     */
    public function iso88591(){
        return $this->charset(CHARSET_ISO88591);
    }

}