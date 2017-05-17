<?php
/**
 * Angello IP Management 
 * PHP Version 7
 *
 * @category PHP
 * @package  Angello
 * @author   Esteban Monge <estebanmonge@riseup.net>
 * @license  https://opensource.org/licenses/BSD-2-Clause BSD
 * @link     http://www.hashbangcode.com/
 */

class Database
{
    private static $dbPath = '/var/www/html/kanboard/data/db.sqlite';

    private static $cont = null;

    public function __construct()
    {
        die('Init function is not allowed');
    }

    public static function connect()
    {
        // One connection through whole application
        if (null == self::$cont) {
            try {
                self::$cont = new PDO('sqlite:/'.self::$dbPath);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }

        return self::$cont;
    }

    public static function disconnect()
    {
        self::$cont = null;
    }
}
