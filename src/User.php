<?php

namespace Florence;

class User
{
    use Connection;

    /**
     * @var $table
     * @var $sql
     * This Method creates the table in the database
     */
    public function create(){

        $table = strtolower(end(explode( '\\', get_called_class() )));

        $sql = "CREATE TABLE $table
        (
            id serial NOT NULL,
            brand text,
            price text,
            color text,
            CONSTRAINT id_pkey PRIMARY KEY (id)
            )";

        $this->connect()->exec($sql);
    }
}
