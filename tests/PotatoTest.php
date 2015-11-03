<?php

namespace Florence\Test;

use Florence\Car;
use Florence\User;

class PotatoTest extends \PHPUnit_Framework_TestCase
{
    public function testDestroy()
    {
        $this->assertEquals(true, Car::destroy(27));
        $this->assertEquals(true, User::destroy(6));
    }

    public function testSave()
    {

    }

    public function tearDown()
    {

    }
}
