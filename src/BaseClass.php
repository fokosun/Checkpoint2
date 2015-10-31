<?php

namespace Florence;

abstract class BaseClass {
    use Connection;

    public function create() {

        /** @var
         * $sql
         *
         */
        $table = strtolower(end(explode( '\\', get_called_class() )));

        $sql = "CREATE TABLE $table
        (
            id serial NOT NULL,
            brand text,
            price text,
            color text,
            CONSTRAINT id_pkey PRIMARY KEY (id)
            )";

        $mql = "INSERT INTO car(brand, price, color) VALUES ('corolla', 8000, 'red')";

        $this->connect()->exec($sql);
        $this->connect()->exec($mql);
    }

   abstract protected function find();
   abstract protected function update();
   abstract protected function delete();
}
