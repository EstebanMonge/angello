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

class database
{
    private static $dbName = 'angello';
    private static $dbHost = 'localhost';
    private static $dbUsername = 'angello';
    private static $dbUserPassword = 'angello';

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
                self::$cont = new PDO('mysql:host='.self::$dbHost.';'.'dbname='.self::$dbName, self::$dbUsername, self::$dbUserPassword);
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
