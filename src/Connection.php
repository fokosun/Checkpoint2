<?php

namespace Florence;

use PDO;

trait Connection {
    public function connect(){
        $envReader = new EnvReader();
        $envReader->loadEnv();

        $db = getenv('DB_DATABASE');
        $host = getenv('DB_host');
        $username = getenv('DB_USERNAME');
        $password = getenv('DB_PASSWORD');
        $connection = getenv('DB_CONNECTION');

        try {
            $cxn = new PDO("$connection:dbname=$db;host=$host", $username, $password, [PDO::ATTR_PERSISTENT => true] );

            return $cxn;

        }

        catch(PDOException $e) {
            return $e->getMessage();
        }

    }
}
