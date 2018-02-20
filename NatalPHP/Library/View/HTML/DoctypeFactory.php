<?php
namespace NatalPHP\View\HTML;
/* SVN FILE: $Id: DoctypeFactory.php 45 2010-01-10 20:05:40Z Sadjow $ */
/**
 * DoctypeFactory class file.
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


    // HTML 5
    const DOCTYPE_HTML5 = 'HTML 5';

    // HTML 4.01
    const DOCTYPE_HTML_401_STRICT = 'HTML 4.01 Strict' ;
    const DOCTYPE_HTML_401_TRANSITIONAL = 'HTML 4.01 Transitional';
    const DOCTYPE_HTML_401_FRAMESET = 'HTML 4.01 Frameset';

    // XHTML 1.0
    const DOCTYPE_XHTML_10_STRICT = 'XHTML 1.0 Strict';
    const DOCTYPE_XHTML_10_TRANSITIONAL = 'XHTML 1.0 Transitional';
    const DOCTYPE_XHTML_10_FRAMESET = 'XHTML 1.0 Frameset';

    // XHTML 1.1
    const DOCTYPE_XHTML_11 = 'XHTML 1.1';

/**
 * Class DoctypeFactory. Helps to create doctypes.
 *
 * "The <!DOCTYPE> declaration must be the very first thing in your HTML5 document,
 * before the <html> tag. This tag tells the browser which HTML specification the document uses.
 * The doctype declaration is not an HTML tag; it is an instruction to the web browser about what
 * version of the markup language the page is written in.
 * It is important that you specify the doctype in all HTML documents,
 * so that the browser knows what type of document to expect.
 * The doctype in HTML 4.01 required a reference to a DTD, because HTML 4.01 was based on SGML.
 * HTML 5 is not based on SGML, and does not require a reference to a DTD,
 * but need the doctype for browsers to behave as they should." (www.w3schools.com)
 *
 * @package       NatalPHP
 * @subpackage    NatalPHP.NatalPHP.View.HTML
 */
class DoctypeFactory {

    /**
     * Just to ensure the safety of instantiation. =)
     * @access private
     */
    private function  __construct() {}

    /**
     * Create a new DOCTYPE for page.
     * @param string $doctype
     * @return string The <!DOCTYPE ...>
     */
    public static function Create($doctype){
        switch($doctype){

            case DOCTYPE_HTML5:
                return '<!DOCTYPE HTML>';
                break;

            case DOCTYPE_HTML_401_STRICT:
                return '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">';
                break;

            case DOCTYPE_HTML_401_TRANSITIONAL:
                return '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
                break;

            case DOCTYPE_HTML_401_FRAMESET:
                return '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">';
                break;

            case DOCTYPE_XHTML_10_STRICT:
                return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
                break;

            case DOCTYPE_XHTML_10_TRANSITIONAL:
                return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
                break;

            case DOCTYPE_XHTML_10_FRAMESET:
                return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">';
                break;

            case DOCTYPE_XHTML_11:
                return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">';
                break;
        }
    }

}
