<?php

namespace Florence\Test;

use Florence\Model;
use Mockery as m;

/**
 * Class ModelTest
 */
class ModelTest extends \PHPUnit_Framework_TestCase
{
    protected $user;
    protected $stmt;
    protected $connection;

    /**
     * Teardown method
     *
     * @return void
     */
    public function tearDown()
    {
        m::close();
    }

    /**
     * Test create method
     *
     * @return void
     */
    public function testCreate()
    {
        $mock = m::mock('Florence\User');

        $mock->first_name = "Taylor";
        $mock->last_name = "Otwell";
        $mock->stack = "Laravel";

        $mock->shouldReceive('getProperties')->andReturn(
            [
                'first_name' => 'Taylor',
                'last_name' => 'Otwell',
                'stack' => 'Laravel',
            ]
        );

        $this->assertArrayHasKey('first_name', $mock->getProperties());
        $this->assertArrayHasKey('last_name', $mock->getProperties());
        $this->assertArrayHasKey('stack', $mock->getProperties());

        $this->assertInstanceOf('Florence\Model', $mock);

        $this->assertInternalType('array', $mock->getProperties());

        $this->assertArrayHasKey('first_name', $mock->getProperties());
        $this->assertArrayHasKey('last_name', $mock->getProperties());
        $this->assertArrayHasKey('stack', $mock->getProperties());

        $this->assertNotEmpty($mock->getProperties());
    }

    /**
     * Test that instance properties can set/get
     */
    public function testInstancePropertiesCanSetGet()
    {
        $mock = m::mock('Florence\User');

        $mock->first_name = "Taylor";
        $mock->last_name = "Otwell";
        $mock->email = "taylor.otwell@laravel.com";
        $mock->phone = "+2348022503376";

        $fields = [
            "first_name" => "Taylor",
            "last_name" => "Otwell",
            "email" => "taylor.otwell@laravel.com",
            "phone" => "+2348022503376",
        ];

        $mock->shouldReceive('getProperties')->andReturn(
            [
                "first_name" => "Taylor",
                "last_name" => "Otwell",
                "email" => "taylor.otwell@laravel.com",
                "phone" => "+2348022503376",
            ]
        );

        $this->assertEquals($fields, $mock->getProperties());

        $this->assertEquals('Taylor', $mock->first_name);
        $this->assertEquals('Otwell', $mock->last_name);
        $this->assertEquals('taylor.otwell@laravel.com', $mock->email);
        $this->assertEquals('2348022503376', $mock->phone);
    }

    /**
     * Test table name
     */
    public function testTableName()
    {
        $mock = m::mock('Florence\User');

        $mock->shouldReceive('getTableName')->andReturn('users');

        $this->assertEquals('users', $mock::getTableName());
    }

    /**
     * Test getAll method
     *
     * @return void
     */
    public function testGetAll()
    {
        $mock = m::mock('Florence\User');

        $mock->shouldReceive('getAll')->andReturn(
            [
                'id' => 1,
                'first_name' => 'Frank',
                'last_name' => 'Dunga',
                'stack' => 'Comedy on Rails'
            ]
        );

        $this->assertArrayHasKey('id', $mock->getAll());
        $this->assertArrayHasKey('first_name', $mock->getAll());
        $this->assertArrayHasKey('last_name', $mock->getAll());
        $this->assertArrayHasKey('stack', $mock->getAll());

        $this->assertContains('Frank', $mock->getAll());
        $this->assertContains('Dunga', $mock->getAll());
        $this->assertContains('Comedy on Rails', $mock->getAll());
    }

    /**
     * Test find method
     *
     * @return void
     */
    public function testFind()
    {
        $mock = m::mock('Florence\User');

        $mock->shouldReceive('find')
            ->with(1)
            ->andReturn('foo');

        $this->assertEquals('foo', $mock->find(1));
    }

    /**
     * Test to see if a new model instance has unpopulated properties
     *
     * @return void
     */
    public function testNewInstanceCreatesInstanceWithoutAttributes()
    {
        $mock = m::mock('Florence\User');
        $mock->shouldReceive('getProperties')->andReturn([]);

        $this->assertEmpty($mock->getProperties());
        $this->assertEquals(0, sizeof($mock->getProperties()));
        $this->assertEquals(0, count($mock->getProperties()));
        $this->assertArrayNotHasKey('id', $mock->getProperties());
    }

     /**
     * Test destroy method
      *
      * @return void
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
