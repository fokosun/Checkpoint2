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

    public function testCreate()
    {
        $user = new User();
        $user->first_name = "Taylor";
        $user->last_name = "Otwell";
        $user->stack = "Laravel";

        $properties = $user->getProperties();
        $this->assertArrayHasKey('first_name', $properties);
        $this->assertNotEmpty($user->getProperties());
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

    public function testFind()
    {
        $mock = m::mock('Florence\User');
        $mock->shouldReceive('find')
            ->with(1)
            ->andReturn('Jargons');
    }

    public function testFindException()
    {
        // $mock = m::mock('Florence\User');
        // $mock->shouldReceive('find')
        // ->with(35)
        // ->andReturn(NULL);

        // // $this->setExpectedException('Florence\RecordNotFoundException');

        // // User::find(35, $this->connection);
    }

    public function testDestroy()
    {
        $this->connection->shouldReceive('prepare')->with("DELETE FROM users WHERE id = 12")->andReturn($this->stmt);
        $this->stmt->shouldReceive('execute');
        $this->stmt->shouldReceive('rowCount')->andReturn(1);

        $this->assertTrue(User::destroy(12, $this->connection));
    }

}
