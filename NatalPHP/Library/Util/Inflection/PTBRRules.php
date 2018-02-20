<?php
namespace NatalPHP\Util\Inflection;
/* SVN FILE: $Id: PTBR_InflectorRules.php 54 2010-01-11 00:56:26Z Sadjow $ */
/**
 * PTBR_InflectorRules class file.
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
require_once('Rules.php');
/**
 * PTBR_InflectorRules class
 * @package NatalPHP
 * @subpackage NatalPHP.NatalPHP.Util.Inflection
 */
class PTBRRules implements Rules {

    /**
     * Gets the irregular prural array.
     * @return array
     */
    public function getIrregularPrural(){
        return array(
        'abdomens' => 'abdomen',
        'alemao' => 'alemaes',
        'artesa' => 'artesaos',
        'as' => 'ases',
        'bencao' => 'bencaos',
        'cao' => 'caes',
        'capelao' => 'capelaes',
        'capitao' => 'capitaes',
        'chao' => 'chaos',
        'charlatao' => 'charlataes',
        'cidadao' => 'cidadaos',
        'consul' => 'consules',
        'cristao' => 'cristaos',
        'dificil' => 'dificeis',        
        'escrivao' => 'escrivaes',
        'fossel' => 'fosseis',
        'germens' => 'germen',
        'grao' => 'graos',
        'hifens' => 'hifen',
        'irmao' => 'irmaos',
        'liquens' => 'liquen',
        'mal' => 'males',
        'mao' => 'maos',
        'orfao' => 'orfaos',
        'pais' => 'paises',
        'pao' => 'paes',
        'perfil' => 'perfis',
        'projetil' => 'projeteis',
        'reptil' => 'repteis',
        'sacristao' => 'sacristaes',
        'sotao' => 'sotaos',
        'tabeliao' => 'tabeliaes'
        );
    }

    /**
     * Gets the singular irregular array.
     * @return array.
     */
    public function getIrregularSingular(){
        return array_flip($this->getIrregularPrural());
    }
    
    /**
     * Return the prural rules array
     * @access public
     * @return array
     */
    public function getPruralRules(){
        return array(
            '/^(.*)ao$/i' => '\1oes',
            '/^(.*)(r|s|z)$/i' => '\1\2es',
            '/^(.*)(a|e|o|u)l$/i' => '\1\2is',
            '/^(.*)il$/i' => '\1is',
            '/^(.*)(m|n)$/i' => '\1ns',
            '/^(.*)$/i' => '\1s'
            );
    }

    /**
     * Gets the singular rules.
     * @return array
     */
    public function getSingularRules(){
        return array(
            '/^(.*)(oes|aes|aos)$/i' => '\1ao',
            '/^(.*)(a|e|o|u)is$/i' => '\1\2l',
            '/^(.*)e?is$/i' => '\1il',
            '/^(.*)(r|s|z)es$/i' => '\1\2',
            '/^(.*)ns$/i' => '\1m',
            '/^(.*)s$/i' => '\1',
            );
    }

    /**
     * Gets the uninflected words.
     * @return array
     */
    public function getUninflected(){
        return array('atlas', 'lapis', 'onibus', 'pires', 'virus', '.*x', 'ferias');
    }

}