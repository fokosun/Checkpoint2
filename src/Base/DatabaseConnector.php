<?php

namespace Florence;

use Florence\EnvReader;
use PDO;
use PDOException;
use \InvalidArgumentException;

class DatabaseConnector implements DatabaseInterface{
    protected $dsn = [];
    protected $database;
    protected $host;
    protected $username;
    protected $password;
    protected $driver;

    public function connect(){

        $envReader = new EnvReader();
        $envReader->load();

        $this->database = getenv('DB_DATABASE');
        $this->host = getenv('DB_host');
        $this->username = getenv('DB_USERNAME');
        $this->password = getenv('DB_PASSWORD');
        $this->driver = getenv('DB_CONNECTION');

        $this->dsn = [$this->database, $this->host, $this->username, $this->password, $this->driver];
        list($database, $host, $username, $password, $driver) = $this->dsn;

        try {
            $cxn = new PDO("$driver:dbname=$database;host=$host", $username, $password,[PDO::ATTR_PERSISTENT => true] );

            return $cxn;

        }

        catch(PDOException $e) {
            return $e->getMessage();
        }

    }

    public function disconnect(){
        pg_close($this->connect());

        return true;
    }

    public function select($table, $field=NULL, $value=NULL){

    }
    public function insert($table, array $data){}
    public function update($table, array $data, $conditions){}
    public function delete($table, $conditions){}

    /**
     * this guy should close connection wa instance of this class is destroyed
     */
    public function _destruct(){
        $this->disconnect();
    }
}