<?php

namespace Florence\Test;

use Florence\Car;
use Florence\User;

class PotatoTest extends \PHPUnit_Framework_TestCase
{
    public function testDestroy()
    {
        $this->assertTrue(Car::destroy(23));
        $this->assertTrue(User::destroy(4));
    }

    public function testSave()
    {

    }
}
