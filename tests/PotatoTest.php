<?php

namespace Florence\Test;

use Florence\Car;
use Florence\User;
use Florence\DatabaseConnector;

class PotatoTest extends \PHPUnit_Framework_TestCase
{

    public function testDestroy()
    {
        $this->assertTrue(Car::destroy(16));
        $this->assertTrue(User::destroy(2));
    }

}
