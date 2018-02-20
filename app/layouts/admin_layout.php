<?php
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

require_once dirname(dirname(__DIR__)) . '/NatalPHP/Library/View/HTMLLayout.php';

use NatalPHP\View;

class AdminLayout extends View\HTMLLayout {

    public function  __construct($title) {
        parent::__construct($title);
        
        $this->css('admin/screen.css', 'screen');

        $this->js(array(
            'jquery/jquery-1.4.2.min.js',
            'jquery/custom_jquery.js',
            'jquery/jquery.pngFix.pack.js'
            ));
    }

    public function js($files){
        $this->__prefix(RELATIVE_JS, $files);
        return parent::js($files);
    }

    public function css($sheets, $media = null){
        $this->__prefix(RELATIVE_CSS, $sheets);
        return parent::css($sheets);
    }

}
