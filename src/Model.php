<?php
/**
 * Created by Florence Okosun.
 * Project: Checkpoint Two
 * Date: 11/4/2015
 * Time: 4:07 PM
 */

namespace Florence;

use PDOException;

abstract class Model implements ModelInterface
{
    /**
    * @var properties array to hold column name and values
    */
    protected  $properties = [];

    /**
    * @param string $key rep column name
    * @param string $val rep column value
    * sets into $propertie the $key => $value pairs
    */
    public  function __set($key, $val)
    {
        $this->properties[$key] = $val;
    }

    /**
    * @param string $key reps the column name
    * @return $key and $value
    */
    public function __get($key)
    {
        return $this->properties[$key];
    }

    /**
    * Gets the name of the child class only
    * without the namespace
    * @var $className
    * @var $table
    * @return $table
    */
    public static function getTable()
    {
        $className = explode('\\', get_called_class());
        $table = strtolower(end($className) .'s');

        return $table;
    }

    /**
    * inserts record into the database
    * @param $properties
    * @param $connection initialised to null
    * @return rowCount
    */
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

    /**
    * fetches all records from the database
    * @param $connection initialised to null
    * @return associative array
    */
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

    /**
    * returns a particular record
    * @param $row reps the record id
    * @param $connection initialised to null
    * @return associative array
    */
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

    /**
    * @param row reps record id
    * @param $connection initialised to null
    * @return boolean
    */
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
