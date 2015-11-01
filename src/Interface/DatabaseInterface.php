<?php

namespace Florence;

interface DatabaseInterface
{
    public function connect();

    public function disconnect();

    function select($table, $field = NULL, $value = NULL);

    function insert($table, array $data);

    function update($table, array $data, $conditions);

    function delete($table, $conditions);
}









