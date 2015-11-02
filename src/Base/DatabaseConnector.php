<?php

namespace Florence;

use Florence\EnvReader;
use PDO;
use PDOException;

class DatabaseConnector implements DatabaseInterface{
    protected static $dsn = [];
    protected static $database;
    protected static $host;
    protected static $username;
    protected static $password;
    protected static $driver;

    public static function connect(){

        $envReader = new EnvReader();
        $envReader->load();

        self::$database = getenv('DB_DATABASE');
        self::$host = getenv('DB_host');
        self::$username = getenv('DB_USERNAME');
        self::$password = getenv('DB_PASSWORD');
        self::$driver = getenv('DB_CONNECTION');

        self::$dsn = [self::$database, self::$host, self::$username, self::$password, self::$driver];
        list($database, $host, $username, $password, $driver) = self::$dsn;

        try {
            $cxn = new PDO("$driver:dbname=$database;host=$host", $username, $password,[PDO::ATTR_PERSISTENT => true] );

            return $cxn;

        }

        catch(PDOException $e) {
            return $e->getMessage();
        }

    }

}