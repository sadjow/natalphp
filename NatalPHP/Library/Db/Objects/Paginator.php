<?php
namespace NatalPHP\Db\Objects;

use NatalPHP\Db\Objects\Query;
use NatalPHP\Db\Connections\Connection;
require_once __DIR__ . '/Query.php';
/* SVN FILE: $Id$ */
/**
 *
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
 * @subpackage    NatalPHP.NatalPHP.Db.Proxies
 * @since         NatalPHP(tm) v 0.1
 * @version       $Rev$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

class Paginator extends Query {
    private $rowsPerPage = 10;
    private $currentPage = 1;
    private $totalRows   = null;
    private $totalPages  = null;
    private $firstIndex       = null;
    private $lastIndex       = null;

    function __construct($tableName,Connection $connection = null) {
        parent::__construct($tableName, $connection);
    }

    public function getRowsPerPage() {
        return $this->rowsPerPage;
    }

    public function setRowsPerPage($rowsPerPage) {
        $this->rowsPerPage = $rowsPerPage;
        return $this;
    }

    public function getPage() {
        return $this->currentPage;
    }

    public function setPage($currentPage) {
        $this->currentPage = $currentPage;
        return $this;
    }

    public function getTotalRows() {
        return $this->totalRows;
    }

    public function getTotalPages() {
        return $this->totalPages;
    }

    public function fetch() {        
        $tmpFields = $this->fields;
        $this->limit(null, null);
        $this->select('COUNT(*) as t');
        $total = parent::fetch();
        $sum = 0;
       
        if (!empty($groupBy)) {
            $sum = count($total);
        } else {
            foreach ($total as $subTotal) {
                $sum += $subTotal['t'];
            }
        }        
        $this->totalRows   = $sum;

        $this->totalPages  = ceil($sum / $this->rowsPerPage);
        if ($this->currentPage > $this->totalPages || $this->currentPage < 1)
            $this->currentPage = 1;

        $offset = ($this->currentPage - 1) * $this->rowsPerPage;
        $this->firstIndex  = $offset + 1;
        $this->lastIndex   = $offset + $this->rowsPerPage;
        $this->limit($this->rowsPerPage, $offset);
        $this->fields = $tmpFields;
        return parent::fetch();
    }

    public function getFirstRowIndex() {
        return $this->firstIndex;
    }
    
    public function getLastRowIndex() {
        return $this->lastIndex;
    }
    /**
     * @return Paginator
     */
    public static function create($tableName, Connection $connection = null) {
        return new Paginator($tableName, $connection);
    }
    
}