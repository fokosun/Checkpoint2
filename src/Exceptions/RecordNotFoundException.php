<?php
/**
 * Created by Florence Okosun.
 * Project: Checkpoint Two
 * Date: 11/3/2015
 * Time: 3:48 PM
 */

namespace Florence;


class RecordNotFoundException extends \Exception
{
    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
    * @return Exception Message
    */
    public function getExceptionMessage()
    {
        return $this->message;
    }
}
