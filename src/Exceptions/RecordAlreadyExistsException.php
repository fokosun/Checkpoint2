<?php
/**
 * Created by Florence Okosun.
 * User: Andela
 * Date: 11/3/2015
 * Time: 3:49 PM
 */

namespace Florence;

class RecordAlreadyExistsException extends \Exception
{
    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function getExceptionMessage()
    {
        return $this->message;
    }
}
