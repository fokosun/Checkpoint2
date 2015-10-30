<?php

namespace Florence;

use PDO;
use Florence\EnvReader;

abstract class Base {

    public function connect()
    {
        $envReader = new EnvReader();
        $envReader->loadEnv();

        $db = getenv('DB_DATABASE');
        $host = getenv('DB_host');
        $username = getenv('DB_USERNAME');
        $password = getenv('DB_PASSWORD');
        $connection = getenv('DB_CONNECTION');

        try {
            $cxn = new PDO("$connection:dbname=$db;host=$host", $username, $password);
            return $cxn;
        }
        catch(PDOException $e) {
            return $e->getMessage();
        }
    }

   abstract public function create();
   abstract public function save();
   abstract public function find();
   abstract public function update();
   abstract public function delete();

}
