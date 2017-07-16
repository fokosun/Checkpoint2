<?php
/**
 * Created by Florence Okosun.
 * Project: Checkpoint Two
 * Date: 11/3/2015
 * Time: 3:48 PM
 */

namespace Florence;

use Exception;

/**
 * Class RecordNotFoundException
 * @package Florence
 */
class RecordNotFoundException extends Exception
{
    protected $message;

    /**
     * Initialise class
     *
     * @param string $message exception message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the exception message
     *
    * @return Exception Message
    */
    public function getExceptionMessage()
    {
        return $this->message;
    }
}
