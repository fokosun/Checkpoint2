<?php
/**
 * Created by Florence Okosun.
 * Project: Checkpoint Two
 * Date: 11/4/2015
 * Time: 4:07 PM
 */

namespace Florence;

use PDOException;

/**
 * Class Model
 * @package Florence
 */
abstract class Model implements ModelInterface
{
    /**
    * Table properties
    */
    protected  $properties = [];

    /**
     * Database connection
     */
    static $connection;

    /**
     * Setter
     *
     * @param string $key column name
     * @param string $val column value
     *
     * @return void
    */
    public  function __set($key, $val)
    {
        $this->properties[$key] = $val;
    }

    /**
     * Getter
     *
     * @param string $key column name
     *
     * @return array
    */
    public function __get($key)
    {
        return $this->properties[$key];
    }

    /**
     * Get all the model properties
     *
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Gets the name of the child class
     *
     * @return string
    */
    public static function getTableName()
    {
        $className = explode('\\', get_called_class());
        $table = strtolower(end($className) .'s');

        return $table;
    }

    /**
     * Initialise class
     */
    public function __construct()
    {
        self::$connection = new Connection();
    }

    /**
     * Get connection to database
     *
     * @return Connection
     */
    public function getConnection()
    {
        return self::$connection;
    }

    /**
     * Find a record by id
     *
     * @return object
     */
    public static function find($id, $connection = null)
    {
        if (is_null($connection)) {
            $connection = self::getConnection();
        }

        try {
            $sql =  "SELECT " . "*" . " FROM ";
            $sql = $sql . self::getTableName() . " WHERE id = " . $id;
            $record = $connection->prepare($sql);
            $record->execute();
            $count = $record->rowCount();

            if ($count < 1) {
                throw new RecordNotFoundException(
                    'Record not found!' . PHP_EOL
                );
            }
        } catch (RecordNotFoundException $e) {
            return $e->getMessage();
        } catch(PDOException $e) {
            return $e->getMessage();
        }

        $result = $record->fetchAll($connection::FETCH_CLASS, get_called_class());

        return $result[0];
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

    /** update table with instance properties
    *
    */
    private function update()
    {
        $connection = $this->getConnection();

        $columnNames = "";
        $columnValues = "";
        $count = 0;

        $update = "UPDATE " . $this->getTableName() . " SET " ;
        foreach ($this->properties as $key => $val) {
            $count++;

            if(($key == 'id')) continue;

            $update .= "$key = '$val'";

            if ($count < count($this->properties) )
            {
                $update .=",";
            }
        }
        $update .= " WHERE id = " . $this->properties['id'];
        $stmt = $connection->prepare($update);

            foreach ($this->properties as $key => $val) {
                if($key == 'id') continue;
            }

        $stmt->execute();

        return $stmt->rowCount();
    }

    /**
    * Insert instance data into the table
    */
    private function create()
    {
        $columnNames = "";
        $columnValues = "";
        $count = 0;

        $create = "INSERT" . " INTO " . $this->getTableName()." (";

        foreach ($this->properties as $key => $val) {
            $columnNames .= $key;
            $columnValues .= ':' . $key;
            $count++;

            if ($count < count($this->getProperties())) {
                $columnNames .= ', ';
                $columnValues .= ', ';
            }
        }

        $create .= $columnNames.') VALUES (' .$columnValues.')';

        $stmt = self::$connection->prepare($create);

        foreach ($this->properties as $key => $val) {
            $stmt->bindValue(':'.$key, $val);
        }

        try {
            $stmt->execute();
            $response = $stmt->rowCount();
        } catch(PDOException $e){
            $response = $e->getExceptionMessage();
        }

        return $response;
    }

    /**
    * Checks if the id exists update if exist create if not exist
    */
    public function save()
    {
        var_dump($this);

//        if ($this->id) {
//            $this->update();
//        } else {
//            if ($this->create() > 0) {
//                return 'Record created successfuly!';
//            } else {
//                return 'There was an error';
//            }
//        }
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
                throw new RecordNotFoundException('Record with id ' . $id . ' does not exist.');
            }
        } catch (RecordNotFoundException $e) {
            return $e->getExceptionMessage();
        } catch(PDOException $e) {
            return $e->getExceptionMessage();
        }
        return ($count > 0) ? true : false;
    }
}
