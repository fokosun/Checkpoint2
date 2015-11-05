<?php

namespace Florence\Test;


use Mockery as m;
use Florence\Car;
use Florence\User;

class ModelTest extends \PHPUnit_Framework_TestCase
{
    protected $user;

    public function tearDown() {
        m::close();
    }

    public function testSave()
    {
        $this->user = new User();
        $connection = m::mock('Connection');
        $stmt = m::mock('\PDOStatement');

        $connection->shouldReceive('execute')
            ->with('INSERT INTO users(first_name, last_name, stack) VALUES (Frank, Dunga, Comedy)')
            ->andReturn($stmt);
        $stmt->shouldReceive('rowCount')->andReturn(1);

        $this->assertEquals(1, $this->user->save());
    }

}
