<?php
namespace NatalPHP\Db\Connections;
require_once __DIR__ . '/PDOConnection.php';

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

class DefaultConnector {
    const USER   = 'root';
    const PASS   = '123';
    const HOST   = 'localhost';
    const DBNAME = 'test';

    private static $instance;

    /**
     * @return Connection;
     */
    public static function getConnection() {
        if (self::$instance == null) {
            $dsn = 'mysql:dbname=' . self::DBNAME . ';host=' . self::HOST;
            self::$instance = new PDOConnection($dsn, self::USER, self::PASS);
        }
        return self::$instance;
    }

}