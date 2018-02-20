<?php
namespace NatalPHP\Util\Inflection;
/* SVN FILE: $Id: InflectorRules.php 54 2010-01-11 00:56:26Z Sadjow $ */
/**
 * Rules interface file.
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
 * @subpackage    NatalPHP.NatalPHP.Util.Inflection
 * @since         NatalPHP(tm) v 0.1
 * @version       $Rev: 54 $
 * @modifiedby    $LastChangedBy: Sadjow $
 * @lastmodified  $Date: 2010-01-10 22:56:26 -0200 (dom, 10 jan 2010) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Rules interface
 * @package NatalPHP
 * @subpackage NatalPHP.NatalPHP.Util.Inflection
 */
interface Rules {

    /**
     * Gets the irregular prural array.
     * @return array
     */
    public function getIrregularPrural();

    /**
     * Gets the singular irregular array.
     * @return array.
     */
    public function getIrregularSingular();
    
    /**
     * Return the prural rules array
     * @access public
     * @return array
     */
    public function getPruralRules();

    /**
     * Gets the singular rules.
     * @return array
     */
    public function getSingularRules();

    /**
     * Gets the uninflected words.
     * @return array
     */
    public function getUninflected();

}