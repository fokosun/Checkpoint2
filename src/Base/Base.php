<?php
/**
 * Created by PhpStorm.
 * User: Andela
 * Date: 11/1/2015
 * Time: 11:31 AM
 */

namespace Florence;


abstract class Base extends DatabaseConnector
{

    protected  $properties  = [];

    public  function __set($key, $val)
    {
        $this->properties[$key] = $val;
    }

    public function __get($key)
    {
        return $this->properties[$key];
    }


    public function getTable()
    {
        $table = strtolower(end(explode('\\', get_called_class())).'s');

        return $table;
    }

    public function save()
    {
        $connection = $this->connect();
        $sql = "INSERT INTO ". $this->getTable()." (";
        $columnNames = "";
        $columnValues = "";
        $count = 0;

        foreach($this->properties as $key => $val)
        {
            $columnNames .= $key;
            $columnValues .= ':'. $key;
            $count++;
            if($count < count($this->properties))
            {
                $columnNames .= ', ';
                $columnValues .= ', ';
            }

        }

        $sql .= $columnNames.') VALUES ('.$columnValues.')';

        $stmt = $connection->prepare($sql);

        foreach($this->properties as $key => $val){
            $stmt->bindValue(':'.$key, $val);
        }

        $stmt->execute();
    }
}
