<?php
namespace NatalPHP\View\HTML;
/* SVN FILE: $Id: Element.php 104 2010-05-20 18:38:34Z sadjow $ */
/**
 * Element class file.
 * Defines constants of attributes to use in elements.
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
 * @version       $Rev: 104 $
 * @modifiedby    $LastChangedBy: sadjow $
 * @lastmodified  $Date: 2010-05-20 18:38:34 +0000 (Thu, 20 May 2010) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

    // Standard Attributes for all HTML elements.
    const ATTR_ACCESSKEY        = 'accesskey';
    const ATTR_CLASS            = 'class';
    const ATTR_CONTENTEDITABLE  = 'contenteditable';
    const ATTR_CONTEXTMENU      = 'contextmenu';
    const ATTR_DIR              = 'dir';
    const ATTR_DRAGGABLE        = 'draggable';
    const ATTR_HIDDEN           = 'hidden';
    const ATTR_ID               = 'id';
    const ATTR_ITEM             = 'item';
    const ATTR_ITEMPROP         = 'itemprop';
    const ATTR_IRRELEVANT       = 'irrelevant';
    const ATTR_LANG             = 'lang';
    const ATTR_SPELLCHECK       = 'spellcheck';
    const ATTR_STYLE            = 'style';
    const ATTR_SUBJECT          = 'subject';
    const ATTR_REGISTRATIONMARK = 'registrationmark';
    const ATTR_TABINDEX         = 'tabindex';
    const ATTR_TEMPLATE         = 'template';
    const ATTR_TITLE            = 'title';

    // Area attributes
    const ATTR_SHAPE = 'shape';
    const ATTR_COORDS = 'coords';

    // Graphics Attributes
    const ATTR_ALT   = 'alt';

    // Hiper Reference Attributes
    const ATTR_HREF     = 'href';
    const ATTR_HREFLANG = 'hreflang';
    const ATTR_MEDIA    = 'media';
    const ATTR_PING     = 'ping';
    const ATTR_REL      = 'rel';
    const ATTR_TARGET   = 'target';

    //Forms Attributes
    const ATTR_TYPE     = 'type';
    const ATTR_VALUE    = 'value';
    const ATTR_NAME     = 'name';
    const ATTR_FORMTARGET = 'formtarget';
    const ATTR_FORMNOVALIDATE = 'formnovalidate';
    const ATTR_FORMMETHOD = 'formmethod';
    const ATTR_FORMENCTYPE = 'formenctype';
    const ATTR_FORMACTION = 'formaction';
    const ATTR_FORM = 'form';
    const ATTR_DISABLED = 'disabled';
    const ATTR_AUTOFOCUS = 'autofocus';
    
    //Article Attributes
    const ATTR_CITE = 'cite';
    const ATTR_PUBDATE = 'pubdate';

    // Audio Attributes
    const ATTR_AUTOBUFFER = 'autobuffer';
    const ATTR_AUTOPLAY = 'autoplay';
    const ATTR_CONTROLS = 'controls';
    const ATTR_SRC      = 'src';

    // Meta Attributes
    const ATTR_CONTENT = 'content';
    const ATTR_CHARSET = 'charset';
    const ATTR_HTTP_EQUIV = 'http-equiv';

    // Link Attributes
    const ATTR_SIZES = 'sizes';

    // Script Attributes
    const ATTR_ASYNC = 'async';
    const ATTR_DEFER = 'defer';

    // HTML Attributes
    const ATTR_XMLNS = 'xmlns';
    const ATTR_MANIFEST = 'manifest';

    // Charsets
    const CHARSET_ISO88591 = 'iso-8859-1';
    const CHARSET_UTF8 = 'utf-8';

    // Rel values
    const REL_STYLESHEET = 'stylesheet';
    
    // Types
    const TYPE_TEXT_CSS                 = 'text/css';
    const TYPE_TEXT_ECMASSCRIPT         = 'text/ecmascript';
    const TYPE_TEXT_JAVASCRIPT          = 'text/javascript';
    const TYPE_APPLICATION_ECMASSCRIPT  = 'application/ecmascript';
    const TYPE_APPLICATION_JAVASCRIPT   = 'application/javascript';
    const TYPE_TEXT_VBSCRIPT            = 'text/vbscript';



/**
 * Class representing a HTML element.
 * With this class you can build HTML elements, add and remove attributes.
 * Insert internal content, at the beginning or end, or simply define the content.
 *
 * @package       NatalPHP
 * @subpackage    NatalPHP.NatalPHP.View.HTML
 */
class Element {
    
    /*
     * The tag name of HTML element.
     *
     * @var string
     */
    private $tagName;

    /**
     * Parent Element
     * @var Element
     */
    private $parentElement;

    /*
     * A element can be empty or not.
     *
     * @var bool
     */
    private $isEmpty = false;

    /**
     * before elements.
     * @var array
     */
    private $beforeElements = array();

    /**
     * after elements.
     * @var array
     */
    private $afterElements = array();

    /*
     * The element content. It may be others elements.
     *
     * @var string
     */
    private $content = array();

    /*
     * The element attributes.
     *
     * @var array
     */
    private $attributes = array();

    /*
     * Create new element.
     *
     * @param string $tagName The element tag name.
     * @param bool $isEmpty If the element is a empty element(e.g <br />)
     */
    public function __construct($tagName, $isEmpty = false){
        $this->tagName = $tagName;
        $this->isEmpty = $isEmpty;
    }

    protected function __callProperty($name, $value){
        if($value != null){
            $this->{$name} = $value;
            return $this;
        } else {
            return $this->{$name};
        }
    }

    protected function beforeElements($value = null){
        return $this->__callProperty('beforeElements', $value);
    }

    protected function afterElements($value = null){
        return $this->__callProperty('afterElements', $value);
    }

    public function addClass($className){
        // TODO:
    }

    public function after($element){
        if($this->parentElement != null){
            $this->parentElement->beforeChield($this, $element);
        } else {
            array_push($this->afterElements, $element);
        }
    }

    public function before($element){
        if($this->parentElement != null){
            $this->parentElement->beforeChield($this, $element);
        } else {
            array_push($this->beforeElements, $element);
        }
    }

    
    public function beforeChield($chield, $value){
        $index = array_search($chield, $this->content);
        if($index !== false){
            array_splice($this->content, $index, 0, $value);
        }
    }

    public function afterChield($chield, $value){
        $index = array_search($chield, $this->content);
        $index++;
        if($index !== false){
            array_splice($this->content, $index, 0, $value);
        }
    }

    public function clear(){
        //TODO:
    }

    public function hasClass(){
        // TODO:
    }

    public function html(){
        // TODO:
    }

    public function text(){
        // TODO:
    }

    public function toogleClass(){
        // TODO:
    }

    /*
     *  Returns a concatenated string of attributes.
     */
    private function _getAttributesString(){
        $s = "";
        if(!empty ($this->attributes)){
            foreach($this->attributes as $aName => $aValue){
                $s .= " {$aName}=\"{$aValue}\"";
            }
        }
        return $s;
    }

    

    /**
     * 
     * @param Element $parentElement
     * @return string
     */
    public function parentElement(&$parentElement = null){
        if($parentElement == null)
            return $this->parentElement;
        else{
            $this->parentElement = &$parentElement;

            array_map(array($this, 'beforeChield'), $this->beforeElements, array($this));
            array_map(array($this, 'afterChield'), $this->afterElements, array($this));

            $this->beforeElements = array();
            $this->afterElements = array();
            return $this;
        }
    }

    /**
     * Update the contents parent
     * @param mixed $content
     */
    private function __updateContentParent( array &$content){
            foreach($content as $c)
                if($c instanceof Element)
                    $c->parentElement($this);
    }

    /*
     * Defines the content within this element.
     *
     * @param mixed $content A text or other Element.
     *
     * @return Element Return this element.
     */
    public function content($content = null, $isIncremental = false, $prepend = false){
        
            if($content == null) return $this->content;

            if(!is_array($content))
                $content = array($content);

            // Update the content parent.
            $this->__updateContentParent($content);

            if($isIncremental)
                $this->content = ($prepend) ?
                        array_merge($content, $this->content) :
                        array_merge($this->content, $content);
            else
                $this->content = $content;

            return $this;
    }

    /**
     * Remove a content.
     */
    public function rcontent($content){
        $index = $this->hasContent($content);
        if($index !== false){
            $this->content[$index] = null;
            unset($this->content[$index]);
        }
        return $this;
    }

    


    /*
     * Sets the contents of the beginning of this element.
     *
     * @param mixed $content A text or other Element.
     *
     * @return Element Return this element.
     */
    public function prepend($content){
        return $this->content($content, true, true);
    }

    /*
     * Sets the content of the end of this element.
     *
     * @param mixed $content A text or other Element.
     *
     * @return Element Return this element.
     */
    public function append($content){
        return $this->content($content, true, false);
    }

    /*
     * Sets a attribute to this element.
     * If the '$value' is not set or null, returns the attribute value, if it exists.
     *
     * @param string $name The attribute name.
     * @param string $value The value of attribute.
     * 
     * @return Element Return this element.
     */
    public function attr($name, $value = null){
        if($value != null){
            $this->attributes[$name] = $value;
            return $this;
        } else {
            return (isset($this->attributes[$name])) ? $this->attributes[$name] : null;
        }
    }
    
    /*
     * Remove a attribute to this element.
     *
     * @param string $name The attribute name.
     * @param string $value The value of attribute.
     *
     * @return Element Return this element.
     */
    public function rattr($name){
        unset ($this->attributes[$name] );
        return $this;
    }



     //  ==============================
     //  HTML 5 Standard Attributes
     //  ==============================


    /**
     * Specifies a keyboard shortcut to access an element.
     *
     * @param string $value 
     */
    public function accesskey($value = null){
        return $this->attr(ATTR_ACCESSKEY, $value);
    }

    /**
     * Specifies a classname for an element (used to specify a class in a style sheet).
     *
     * @param string $value
     */
    public function classes($value = null){
        return $this->attr(ATTR_CLASS, $value);
    }

    /**
     * Specifies if the user is allowed to edit the content or not.
     *
     * @param string $value
     */
    public function contenteditable($value = null){
        return $this->attr(ATTR_CONTENTEDITABLE, $value);
    }

    /**
     * Specifies the context menu for an element.
     *
     * @param string $value
     */
    public function contextmenu($value = null){
        return $this->attr(ATTR_CONTEXTMENU, $value);
    }

    /**
     * Specifies the text direction for the content in an element.
     *
     * @param string $value ltr | rtl
     */
    public function dir($value = null){
        return $this->attr(ATTR_DIR, $value);
    }

    /**
     * Specifies whether or not a user is allowed to drag an element.
     *
     * @param string $value true | false | auto
     */
    public function draggable($value = null){
        return $this->attr(ATTR_DRAGGABLE, $value);
    }

    /**
     * Specifies that the element is not relevant. Hidden elements are not displayed.
     *
     * @param string $value hidden
     */
    public function hidden($value = null){
        return $this->attr(ATTR_HIDDEN, $value);
    }
    
    /**
     * Specifies a unique id for an element.
     *
     * @param string $value
     */
    public function id($value = null){
        return $this->attr(ATTR_ID, $value);
    }

    /**
     * Used to group elements.
     *
     * @param string $value empty | url
     */
    public function item($value = null){
        return $this->attr(ATTR_ITEM, $value);
    }

    /**
     * Used to group items.
     *
     * @param string $value url | group value
     */
    public function itemprop($value = null){
        return $this->attr(ATTR_ITEMPROP, $value);
    }

    /**
     * Specifies a language code for the content in an element.
     *
     * @param string $value
     */
    public function lang($value = null){
        return $this->attr(ATTR_LANG, $value);
    }

    /**
     * Specifies if the element must have it's spelling or grammar checked.
     *
     * @param string $value true | false
     */
    public function spellcheck($value = null){
        return $this->attr(ATTR_SPELLCHECK, $value);
    }

    /**
     * Specifies an inline style for an element.
     *
     * @param string $value style_definition
     */
    public function style($value = null){
        return $this->attr(ATTR_STYLE, $value);
    }

    /**
     * Specifies an inline style for an element.
     *
     * @param string $value style_definition
     */
    public function subject($value = null){
        return $this->attr(ATTR_SUBJECT, $value);
    }

    /**
     * Specifies an inline style for an element.
     *
     * @param string $value number
     */
    public function tabindex($value = null){
        return $this->attr(ATTR_SUBJECT, $value);
    }

    /**
     * Specifies extra information about an element.
     *
     * @param string $value text
     */
    public function title($value = null){
        return $this->attr(ATTR_TITLE, $value);
    }
    

    /**
     * Sets if the element is a empty element.
     * Or get information about it if not giving any parameter.
     * 
     * @param bool $bool true or false
     * @return mixed Element or bool
     */
    public function isEmpty($bool = null){
        if($bool === null){
            return $this->isEmpty;
        } else {
            $this->isEmpty = $bool;
            return $this;
        }
    }


    /**
     * Verify the attribute existence.
     * @param string $name
     * @return bool
     */
    public function hasAttr($name){
        return $this->attr($name);
    }

    /**
     * Verify the content existence.
     * @param string|Element $content
     * @return bool|int
     */
    public function hasContent($content){        
        return in_array($content, $this->content);
    }

    //public function beforeBrothers

    public function contentString(){
        return implode('', $this->content);
    }

    public function beforeContent(Element $until = null){

        $output = '';

        $output .= $this->__openTag();

        if($until != null){
            for($i = 0; $i < count($this->content); $i++){
                if( $this->content[$i] == $until ) 
                    break;
                else
                    $output .= $this->content[$i];
            }
        }

        if($this->parentElement == null)
            return $output;
         else
            return $this->parentElement->beforeContent($this) . $output;
    }

    public function afterContent(Element $until = null){
        $output = '';

        $output .= $this->__closeTag();

        if($until != null){
            for($i = count($this->content)-1; $i >= 0; $i--){
                if( $this->content[$i] == $until )
                    break;
                else
                    $output .= $this->content[$i];
            }
        }

        if($this->parentElement == null)
            return $output;
         else
            return $output . $this->parentElement->afterContent($this);
    }

    
    private function __openTag(){
        if($this->isEmpty){
            return implode('', $this->beforeElements) . "<{$this->tagName}{$this->_getAttributesString()} />";
        } else {
            return implode('', $this->beforeElements) . "<{$this->tagName}{$this->_getAttributesString()}>";
        }
    }

    private function __closeTag(){
        if($this->isEmpty){
            return '' . implode('', $this->afterElements);;
        } else {
            return "</{$this->tagName}>" . implode('', $this->afterElements);;
        }
    }

    /*
     * Render the HTML element.
     *
     * @return string Returns the object represented in string.
     */
    public function  __toString() {
        // If is Normal Element
        if($this->isEmpty){
            return implode('', $this->beforeElements) . "<{$this->tagName}{$this->_getAttributesString()} />" . implode('', $this->afterElements);
        } else {
            return implode('', $this->beforeElements) . "<{$this->tagName}{$this->_getAttributesString()}>{$this->contentString()}</{$this->tagName}>" . implode('', $this->afterElements);
        }
    }

}
