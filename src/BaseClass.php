<?php

namespace Florence;

abstract class BaseClass {
    use Connection;

    public function create() {

        /** @var
         * $sql
         *
         */

        $sql = "CREATE TABLE car
        (
            id serial NOT NULL,
            brand text,
            price text,
            color text,
            CONSTRAINT id_pkey PRIMARY KEY (id)
            )";

        $this->connect()->exec($sql);
    }

   abstract protected function insert();
   abstract protected  function find();
   abstract protected  function update();
   abstract protected  function delete();
}
