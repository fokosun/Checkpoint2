<?php
/**
 * Created by Florence Okosun.
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
        $connection = self::connect();
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

    public static function getAll()
    {
        $sql = "SELECT ". "*". "FROM ". self::getTable();
        $row = self::connect()->query($sql)->fetchAll();

        return json_encode($row);
    }

    public static function find($row)
    {
        $row = $row - 1;
        $sql = "SELECT ". "*". "FROM ". self::getTable(). " ORDER BY id LIMIT 1 OFFSET ". $row;
        $rows = self::connect()->query($sql)->fetchAll();

        return json_encode($rows);
    }

    public static function destroy($row)
    {
        $delete = self::connect()->prepare("DELETE FROM " . self::getTable()." WHERE id =". $row);
        $delete->execute();

        $count = $delete->rowCount();

//        return $count;
        return ($count > 0)?true:false;
    }
}
