<?php
namespace NatalPHP\View;
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

require_once dirname(__DIR__) . '/Base/NatalPHPObject.php';
require_once dirname(__DIR__) . '/View/HTML/Element.php';
require_once dirname(__DIR__) . '/View/HTML/Meta.php';
require_once dirname(__DIR__) . '/View/HTML/Html.php';
require_once dirname(__DIR__) . '/View/HTML/Head.php';
require_once dirname(__DIR__) . '/View/HTML/Body.php';
require_once dirname(__DIR__) . '/View/HTML/Title.php';
require_once dirname(__DIR__) . '/View/HTML/DoctypeFactory.php';

require_once dirname(__FILE__) . '/Layout.php';

use NatalPHP\Base;
use NatalPHP\View\HTML;

class HTMLLayout implements Layout, Base\NatalPHPObject {

    
    private $doctype;

    private $htmlElement;

    /**
     * headElement
     * @var Head
     */
    private $headElement;

    private $bodyElement;

    private $charsetMetaElement;

    private $wrapper;
    
    public function  __construct($textOfTitle = 'NatalPHP : Framework') {

        // Instances the charset meta element.
        $this->charsetMetaElement = new HTML\Meta();

        // Sets the charset utf8
        $this->charset(HTML\CHARSET_UTF8);

        // Sets the HTML 5 doctype
        $this->doctype(HTML\DoctypeFactory::Create(HTML\DOCTYPE_HTML5));

        // Instaces the HTML element.
        $this->htmlElement = new HTML\Html();
        $this->htmlElement->before($this->doctype);
        $this->htmlElement->xmlns('http://www.w3.org/1999/xhtml');
        
        // Instaces the head element and defines the title of page.
        $this->headElement = new HTML\Head($textOfTitle);

        // Defines the chartset meta element with a id in head element.
        $this->headElement->meta($this->charsetMetaElement);

        $this->bodyElement = new HTML\Body();

        // Instances the content element, the "wrapper" of page contents.

        $this->wrapper = $this->bodyElement;


        // append Elements
        $this->htmlElement->append($this->headElement)->append($this->bodyElement);
    }

    public function  __toString() {
        
    }

    protected  function __callProperty($name, $value){
        if($value != null){
            $this->{$name} = $value;
            return $this;
        } else {
            return $this->{$name};
        }
    }

    protected function __prefix($prefix, &$target){
        if(!is_array($target))
            $target = $prefix.$target;
        else
            foreach($target as $t)
                $t = $prefix.$t;
    }

    public function header(){
        if($this->wrapper != null){
            return $this->wrapper->beforeContent();
        }else {
            return new Exception('The wrapper element is null in HTMLLayout.
                Please set the wraper $layout->wrapper = $element;');
        }
    }

    public function footer(){
        if($this->wrapper != null){
            return $this->wrapper->afterContent();
        }else {
            return new Exception('The wrapper element is null in HTMLLayout.
                Please set the wraper $layout->wrapper = $element;');
        }
    }
    

    public function doctype($value = null){
        return $this->__callProperty('doctype', $value);
    }

    public function title($value = null){
        if($value != null){
            $this->headElement->title($value);
            return $this;
        } else
            return $this->headElement->title();
    }
    
    public function charset($value = null){
        if($value != null){
            $this->charsetMetaElement->charset($value);
            return $this;
        } else
            return $this->charsetMetaElement->charset();
    }

    public function charsetMetaElement($value = null){
        return $this->__callProperty('charsetMetaElement', $value);
    }

    public function htmlElement($value = null){
        return $this->__callProperty('htmlElement', $value);
    }

    public function headElement($value = null){
        return $this->__callProperty('headElement', $value);
    }

    /**
     *
     * @param Body $value
     * @return Body
     */
    public function bodyElement($value = null){
        return $this->__callProperty('bodyElement', $value);
    }

    public function css($sheets, $media = null){
        $this->headElement()->css($sheets, $media);
    }

    public function js($jsFiles){
        $this->headElement()->js($jsFiles);
    }
    
}