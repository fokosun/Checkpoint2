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
    public static function getTableName()
    {
        $className = explode('\\', get_called_class());
        $table = strtolower(end($className) .'s');

        return $table;
    }

    /**
    * inserts record into the database
    * @param $connection initialised to null
    * @return rowCount
    */
    public function save($connection = null)
    {
        if(is_null($connection))
        {
            $connection = new Connection();
        }

        $columnNames = "";
        $columnValues = "";
        $count = 0;
        $create = "INSERT" . " INTO " . $this->getTableName()." (";

        foreach ($this->properties as $key => $val) {
            $columnNames .= $key;
            $columnValues .= ':' . $key;
            $count++;

            if ($count < count($this->properties))
            {
                $columnNames .= ', ';
                $columnValues .= ', ';
            }
        }

        if ( ! isset ($this->id)  && is_array($this->data) ) {
            $update = "UPDATE " . $this->getTableName() . " SET " . $this->properties[$val] = $key . "=". "'" .$this->properties[$key] . "'" . " WHERE id=". $this->id;
            $stmt = $connection->prepare($update);
            $stmt->execute();
        } else {
            $create .= $columnNames.') VALUES (' .$columnValues.')';
            $stmt = $connection->prepare($create);
                foreach ($this->properties as $key => $val) {
                    $stmt->bindValue(':'.$key, $val);
                }
            $stmt->execute();
        }
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
            $sql = "SELECT " . "*" . " FROM ". self::getTableName();
            $row = $connection->prepare($sql);
            $row->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }

        return $row->fetchAll($connection::FETCH_ASSOC);
    }

    /**
    * returns a particular record
    * @param $row reps the record id
    * @param $connection initialised to null
    * @return associative array
    */

    public static function find($id, $connection = null)
    {
        if (is_null($connection)) {
            $connection = new Connection();
        }

        try
        {
            $sql = "SELECT " . "*" . " FROM " . self::getTableName() . " WHERE id = " . $id;
            $record = $connection->prepare($sql);
            $record->execute();
            $count = $record->rowCount();

            if ($count < 1) {
                throw new RecordNotFoundException('Record Not Found');
            }
        }
        catch (RecordNotFoundException $e) {
            return $e->getMessage();
        }
        $result = new static;
        $result->id = $id;
        $result->data = $record->fetchAll($connection::FETCH_ASSOC);
        return $result;
    }

    /**
    * @param row reps record id
    * @param $connection initialised to null
    * @return boolean
    */
    public static function destroy($id, $connection= null)
    {
        if(is_null($connection)) {
            $connection = new Connection();
        }

        try {
            $sql = "DELETE" . " FROM " . self::getTableName()." WHERE id = ". $id;
            $delete = $connection->prepare($sql);
            $delete->execute();
            $count = $delete->rowCount();

            if ($count < 1) {
                throw new RecordNotFoundException('Record Not Found');
            }
        }
        catch (RecordNotFoundException $e) {
            return $e->getExceptionMessage();
        }
        return ($count > 0) ? true : false;
    }
}
