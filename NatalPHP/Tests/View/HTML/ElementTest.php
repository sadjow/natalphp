<?php

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

require_once dirname(dirname(dirname(__DIR__))) . '/Party/simpletest/autorun.php';
require_once dirname(dirname(dirname(__DIR__))) . '/Library/View/HTML/Element.php';
require_once dirname(dirname(dirname(__DIR__))) . '/Library/View/HTML/B.php';

use NatalPHP\View\HTML;

class ElementTest extends UnitTestCase {

    public $element;

    public function setup(){
        $this->element = new HTML\Element('p');
    }

    public function TestOfContentMethod(){
        $this->assertEqual($this->element->content('TEST'), $this->element);

        $this->assertEqual($this->element->content(), array('TEST'));

        $b = new HTML\B('test');

        // When add a element in other element content,
        // the other element is your parent
        $this->element->content($b);

        $this->assertEqual($b->parentElement(), $this->element);

    }

    public function TestOfParentElementMethod(){

        $b = new HTML\B('');

        $this->assertEqual($b->parentElement($this->element), $b);

        $this->assertEqual($b->parentElement(), $this->element);

    }

    public function TestOfBeforeContentMethod(){

        $this->assertEqual($this->element->content('TEST'), $this->element);

        $this->assertEqual($this->element->content(), array('TEST'));

        $b = new HTML\B('test');

        // When add a element in other element content,
        // the other element is your parent
        $this->element->content($b);

        $this->assertEqual($b->parentElement(), $this->element);

        $this->assertEqual($this->element->contentString(),'<b>test</b>');

        $b->content('test2');

        $this->assertEqual($this->element->contentString(),'<b>test2</b>');
        

    }

    public function TestOfAfterContentMethod(){

        $this->assertEqual($this->element->content('TEST'), $this->element);

        $this->assertEqual($this->element->content(), array('TEST'));

        $b = new HTML\B('test');

        // When add a element in other element content,
        // the other element is your parent
        $this->element->content($b);

        $this->assertEqual($b->parentElement(), $this->element);

    }

}
