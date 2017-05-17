<?php

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
