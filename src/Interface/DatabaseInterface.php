<?php

namespace Florence;

interface DatabaseInterface
{
    public function connect();

    public function disconnect();

    public function query($query);

    public function fetch();

    function select($table, $conditions = ”, $fields = ‘*’, $order = ”, $limit = null, $offset = null);

    function insert($table, array $data);

    function update($table, array $data, $conditions);

    function delete($table, $conditions);

    function getInsertId();

    function countRows();

    function getAffectedRows();
}









