<?php

namespace Florence;

use PDO;

abstract class DatabaseManager {

    public $dbname;
    public $host;
    public $username;
    public $password;

    public function __construct($dbname, $host, $userName, $password) {

        //these guys are going to read from the .env file

        $this->dbname = $dbname;
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
    }

    public function connectToDatabase() {
        // this guy describes how to connect
        // to the databse using the construct
    }

    public function getAll() {

        /** This allows reading data from a particular table
        */
    }

    public function find() {

        /**
        * Update table data already present in the database
        */
    }

    public function destroy() {

        /** Takes care of deletion of table
        * data already present in the database
        */
    }

}
