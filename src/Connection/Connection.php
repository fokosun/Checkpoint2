<?php

/**
 * Created by Florence Okosun.
 * Date: 11/1/2015
 * Time: 11:31 AM
 */

namespace Florence;

use PDO;
use PDOException;
use Dotenv\Dotenv;

/**
 * Class Connection
 *
 * @package Florence
 */
class Connection extends PDO
{
    protected $dsn = [];
    protected $database;
    protected $host;
    protected $username;
    protected $password;
    protected $driver;
    protected $envReader;

    /**
     * Initialise class
     */
    public function __construct()
    {
        /**
        * Load the environment variables
         *
        * @return connection object
        */
        self::loadDotenv();

        $this->database = getenv('DB_DATABASE');
        $this->host = getenv('DB_host');
        $this->username = getenv('DB_USERNAME');
        $this->password = getenv('DB_PASSWORD');
        $this->driver = getenv('DB_CONNECTION');

        $this->dsn = [
            $this->database,
            $this->host,
            $this->username,
            $this->password,
            $this->driver
        ];

        list($database, $host, $username, $password, $driver) = $this->dsn;

        try
        {
            parent::__construct(
                "$driver:dbname=$database;host=$host", $username, $password,
                [PDO::ATTR_PERSISTENT => true]
            );

        }
        catch(PDOException $e)
        {
            return $e->getMessage();
        }
    }

    /**
     * Load dotenv
     *
     * @return void
    **/
    static function loadDotenv()
    {
        if (getenv('APP_ENV') !== 'production') {
            $dotenv = new Dotenv(__DIR__);
            $dotenv->load();
        }
    }

    /**
     * Get Database Name
     *
     * @return string
     */
    public function getDatabase()
    {
        return $this->database;
    }
}
