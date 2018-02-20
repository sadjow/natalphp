<?php
require_once(dirname(dirname(dirname(dirname(__FILE__))))) . '/Library/Util/Inflection/Inflector.php';
require_once(dirname(dirname(dirname(dirname(__FILE__))))) . '/Library/Util/Inflection/PTBRRules.php';
require_once(dirname(dirname(dirname(dirname(__FILE__))))) . '/Party/simpletest/autorun.php';
use NatalPHP\Util;
use NatalPHP\Util\Inflection;


class PTBRRulesTest extends UnitTestCase {

    public $inflector;

    public function setup(){
        $this->inflector = Inflection\Inflector::getInstance();
    }

    public function TestOfPluralizeMethod(){

        $this->assertEqual($this->inflector->pluralize('casa'), 'casas');

        $this->assertEqual($this->inflector->pluralize('perfil'), 'perfis');

        $this->assertEqual($this->inflector->pluralize('captao'), 'captoes');

    }

    public function TestOfSingularizeMethod(){

        $this->assertEqual($this->inflector->singularize('casas'), 'casa');

        $this->assertEqual($this->inflector->singularize('perfis'), 'perfil');

        $this->assertEqual($this->inflector->singularize('captoes'), 'captao');

    }

    public function TestOfUnderscoreMethod(){

        $this->assertEqual($this->inflector->underscore('camelCaseWord'), 'camel_case_word');

        $this->assertEqual($this->inflector->underscore('CamelCaseWord'), 'camel_case_word');

    }


    public function TestOfTableizeMethod(){

        $this->assertEqual($this->inflector->tableize('Pessoa'), 'pessoas');

        $this->assertEqual($this->inflector->tableize('PessoaFisica'), 'pessoas_fisicas');

        $this->assertEqual($this->inflector->tableize('FotoPessoa'), 'fotos_pessoas');

    }


    public function TestOfClassifyMethod(){

        $this->assertEqual($this->inflector->classify('pessoas'), 'Pessoa');

        $this->assertEqual($this->inflector->classify('pessoas_fisicas'), 'PessoaFisica');

    }

}

