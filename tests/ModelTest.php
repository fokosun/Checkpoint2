<?php

namespace Florence\Test;


use Mockery as m;
use Florence\User;
use Florence\Connection;

class ModelTest extends \PHPUnit_Framework_TestCase
{
    protected $user;

    public function tearDown() {
        m::close();
    }

    public function testSave()
    {
        $this->user = new User();
        $this->user->first_name = "Frank";
        $this->user->last_name = "Dunga";
        $this->user->stack = "Comedy";

        $connection = m::mock('Connection');
        $stmt = m::mock('\PDOStatement');

        $connection->shouldReceive('prepare')
            ->with('INSERT INTO users(first_name, last_name, stack) VALUES (?,?,?)')
            ->andReturn($stmt);
        $stmt->shouldReceive('execute')->with(['Frank', 'Dunga', 'Comedy']);
        $stmt->shouldReceive('rowCount')->andReturn(1);

        $this->assertEquals(1, $this->user->save($connection));
    }

}
