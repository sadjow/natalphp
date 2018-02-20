<?php
namespace NatalPHP\Db\Objects;
use \NatalPHP\Db\Connections\Connection;
use \NatalPHP\Base\NatalPHPObject;

require_once dirname(__DIR__) . '/Connections/Connection.php';
require_once dirname(dirname(__DIR__)) . '/Base/NatalPHPObject.php';

abstract class Dao implements NatalPHPObject {

    private $connection;

    function __construct(Connection $connection) {
        $this->connection = $connection;
    }

    abstract function insert($tableName, $data);
    abstract function update($tableName, $data, $conditions, $params = array(), $limit = 1);
    abstract function delete($tableName, $conditions = null, $params = array(), $limit = 1);
    abstract function get($tableName, $conditions = null, $params = array(), $fields = array(), $order = null, $limit = 1);

   /**
    * @return Connection
    */
    public function getConnection() {
        return $this->connection;
    }

    public function setConnection(Connection $connection) {
        $this->connection = $connection;
    }

}