<?php

namespace Florence\Test;


use Mockery as m;
use Florence\Car;
use Florence\User;

class PotatoTest extends \PHPUnit_Framework_TestCase
{

    public function testDestroy()
    {
        $this->assertTrue(true);
    }


    public function tearDown() {
        m::close();
    }

}
