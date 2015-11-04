<?php

namespace Florence\Test;


use Mockery as m;
use Florence\Car;
use Florence\User;

class PotatoTest extends \PHPUnit_Framework_TestCase
{

    public function testDestroy()
    {
        $connection = m::mock('connect');

        $connection->shouldReceive('query')->once()->andReturn();
    }


    public function tearDown() {
        m::close();
    }

}
