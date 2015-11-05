<?php
/**
 * Created by Florence Okosun.
 * Date: 11/1/2015
 * Time: 11:31 AM
 */

namespace Florence;

use PDOException;

abstract class Model implements ModelInterface
{

    protected  $properties = [];

    public  function __set($key, $val)
    {
        $this->properties[$key] = $val;
    }

    public function __get($key)
    {
        return $this->properties[$key];
    }


    public static function getTable()
    {
        $className = explode('\\', get_called_class());
        $table = strtolower(end($className) .'s');

        return $table;
    }

    public function save($properties = [], $connection = null)
    {
        if(is_null($connection))
        {
            $connection = new Connection();
        }

        try{
            $sql = "INSERT" . " INTO " . $this->getTable()." (";
            $columnNames = "";
            $columnValues = "";
            $count = 0;

            foreach ($this->properties as $key => $val)
            {
                $columnNames .= $key;
                $columnValues .= ':' . $key;
                $count++;
                if ($count < count($this->properties))
                {
                    $columnNames .= ', ';
                    $columnValues .= ', ';
                }
            }

            $sql .= $columnNames.') VALUES (' .$columnValues.')';

            $stmt = $connection->prepare($sql);

            foreach ($this->properties as $key => $val)
            {
                $stmt->bindValue(':'.$key, $val);
            }

            $stmt->execute();
        }
        catch (PDOException $e)
        {
          return $e->getMessage();
        }

        $connection = null;

        return $stmt->rowCount();
    }

    public static function getAll($connection = null)
    {
        if (is_null($connection)) {
            $connection = new Connection();
        }

        try
        {
            $sql = "SELECT " . "*" . " FROM ". self::getTable();
            $row = $connection->prepare($sql);
            $row->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }

        return  $row->fetchAll($connection::FETCH_ASSOC);
    }

    public static function find($row, $connection = null)
    {
        if (is_null($connection)) {
            $connection = new Connection();
        }
        try
        {
            $sql = "SELECT " . "*" . " FROM " . self::getTable() . " WHERE id = " . $row;
            $record = $connection->prepare($sql);
            $record->execute();
        }
        catch (PDOException $e)
        {
            return $e->getMessage();
        }
        return $record->fetchAll($connection::FETCH_ASSOC);
    }

    public static function destroy($row, $connection= null)
    {
        if(is_null($connection))
        {
            $connection = new Connection();
        }

        try
        {
            $sql = "DELETE" . " FROM " . self::getTable()." WHERE id = ". $row;
            $delete = $connection->prepare($sql);
            $delete->execute();
            $count = $delete->rowCount();

            if ($count < 1)
            {
                throw new RecordNotFoundException('Record Not Found');
            }
        }
        catch (RecordNotFoundException $e)
        {
            return $e->getExceptionMessage();
        }

        return ($count > 0) ? true : false;
    }
}
