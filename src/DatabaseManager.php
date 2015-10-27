<?php

namespace Florence;

use PDO;

public abstract class DatabaseManager {

    protected $database;
    protected $host;
    protected $userName;
    protected $password;

    public function __construct($database, $host, $userName, $password) {

        //these guys are going to read from the .env file

        $this->databse = $databse;
        $this->host = $host;
        $this->userName = $userName;
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
