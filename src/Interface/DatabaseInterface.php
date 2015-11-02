<?php

namespace Florence;

interface DatabaseInterface
{
    public static function connect();

    function select($table, $field = NULL, $value = NULL);

    function insert($table, array $data);

    function update($table, array $data, $conditions);

    function delete($table, $conditions);
}