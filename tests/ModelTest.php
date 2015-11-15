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
        $this->assertArrayHasKey('last_name', $properties);
        $this->assertNotEmpty($user->getProperties());
    }

    public function testGetAll()
    {
        $mock = m::mock('Florence\User');
        $mock->shouldReceive('getAll')
            ->andReturn(['id' => 1, 'first_name' => 'Frank', 'last_name' => 'Dunga', 'stack' => 'Comedy on Rails']);

        $this->assertArrayHasKey('id', $mock->getAll());
        $this->assertContains('Frank', $mock->getAll());
        $this->assertContains('Dunga', $mock->getAll());
        $this->assertContains('Comedy on Rails', $mock->getAll());
    }

    /**
     * Test id exists
     */
    public function testFind()
    {
        $mock = m::mock('Florence\User');
        $mock->shouldReceive('find')
            ->with(1)
            ->andReturn('Jargons');

        $this->assertEquals('Jargons',$mock->find(1));

    }

    /**
     * Test to see if a new model instance has unpopulated properties
     */
    public function testNewInstanceCreatesInstanceWithoutAttributes()
     {
        $model = new User();
        $this->assertEmpty($model->getProperties());
        $this->assertEquals(0, sizeof($model->getProperties()));
        $this->assertEquals(0, count($model->getProperties()));
        $this->assertArrayNotHasKey('id', $model->getProperties());
     }

     /**
     * Test user can be deleted
     */
    public function testDestroy()
    {
        $mock = m::mock('Florence\User');
        $mock->shouldReceive('destroy')
            ->with(1)
            ->andReturn(true);

        $this->assertTrue($mock->destroy(1));
    }

}
