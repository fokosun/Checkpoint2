<?php

namespace Florence\Test;


use Mockery as m;
use Florence\User;
use Florence\Connection;

class ModelTest extends \PHPUnit_Framework_TestCase
{
    protected $user;
    protected $connection;
    protected $stmt;


    public function setUp()
    {
        $this->connection = m::mock('Florence\Connection');
        $this->stmt = m::mock('\PDOStatement');
    }
    public function tearDown() {
        m::close();
    }

    public function testSave()
    {
        $this->user = new User();
        $this->user->first_name = "Frank";
        $this->user->last_name = "Dunga";
        $this->user->stack = "Comedy On Rails";

        $this->connection->shouldReceive('prepare')
            ->with("INSERT INTO users (first_name, last_name, stack) VALUES (:first_name, :last_name, :stack)")
            ->andReturn($this->stmt);
        $this->stmt->shouldReceive('bindValue')->with(':first_name', 'Frank');
        $this->stmt->shouldReceive('bindValue')->with(':last_name', 'Dunga');
        $this->stmt->shouldReceive('bindValue')->with(':stack', 'Comedy');

        $this->stmt->shouldReceive('execute');
        $this->stmt->shouldReceive('rowCount')->andReturn(1);

        $this->assertEquals(1, $this->user->save($this->connection));
    }

    public function testGetAll()
    {
        $this->connection->shouldReceive('prepare')->with("SELECT * FROM users")->andReturn($this->stmt);
        $this->stmt->shouldReceive('execute');

        $this->stmt->shouldReceive('rowCount')->andReturn(2);
        $this->stmt->shouldReceive('fetchAll')->with(Connection::FETCH_ASSOC)
            ->andReturn([['id' => 1, 'first_name' => 'Frank', 'last_name' => 'Dunga', 'stack' => 'Comedy on Rails'],
                ['id' =>2, 'first_name' => 'Florence', 'last_name' => 'Okosun', 'stack' => 'PHPLaravel']]);

        $this->assertCount(2, User::getAll($this->connection));

    }

    public function testDestroy()
    {
        $this->connection->shouldReceive('prepare')->with("DELETE FROM users WHERE id = 12")->andReturn($this->stmt);
        $this->stmt->shouldReceive('execute');
        $this->stmt->shouldReceive('rowCount')->andReturn(1);

        $this->assertTrue(User::destroy(24, $this->connection));

    }

}
