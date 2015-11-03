<?php

namespace Florence\Test;

use Florence\Car;
use Florence\User;

class PotatoTest extends \PHPUnit_Framework_TestCase
{
    public function testDestroy()
    {
        $this->assertTrue(Car::destroy(20));
        $this->assertTrue(User::destroy(7));
    }

    public function testSave()
    {

    }

    public function tearDown()
    {

    }
}
