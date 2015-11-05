<?php

namespace Florence\Test;


use Mockery as m;
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
        $this->user->first_name = "Frank";
        $this->user->last_name = "Dunga";
        $this->user->stack = "Comedy";

        $connection = m::mock('Florence\Connection');
        $stmt = m::mock('\PDOStatement');

        $connection->shouldReceive('prepare')
            ->with("INSERT INTO users (first_name, last_name, stack) VALUES (:first_name, :last_name, :stack)")
            ->andReturn($stmt);
        $stmt->shouldReceive('bindValue')->with(':first_name', 'Frank');
        $stmt->shouldReceive('bindValue')->with(':last_name', 'Dunga');
        $stmt->shouldReceive('bindValue')->with(':stack', 'Comedy');

        $stmt->shouldReceive('execute');
        $stmt->shouldReceive('rowCount')->andReturn(1);

        $this->assertEquals(1, $this->user->save($connection));
    }

//    public function testGetAll()
//    {
//        $connection = m::mock('Florence\Connection\Connection');
//        $stmt = m::mock('\PDOStatement');
//
//        $connection->shouldReceive('prepare')->with('SELECT * FROM users')->andReturn($stmt);
//        $stmt->shouldReceive('execute');
//        $stmt->shouldReceive('rowCount')->andReturn(1);
//        $stmt->shouldReceive('fetchAll')->with($connection)
//            ->andReturn(['id' => 1, 'first_name' => 'Frank']);
//
//        $this->assertCount(1, User::getAll($connection::FETCH_ASSOC));
//    }

}
