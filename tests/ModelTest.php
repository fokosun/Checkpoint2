<?php

namespace Florence\Test;

use Mockery as m;
use Florence\RecordNotFoundException;

/**
 * Class ModelTest
 */
class ModelTest extends \PHPUnit_Framework_TestCase
{
    protected $user;
    protected $stmt;
    protected $connection;

    /**
     * Setup method
     *
     * @return void
     */
    public function setUp()
    {
        $this->connection = m::mock('Florence\Connection');
        $this->stmt = m::mock('\PDOStatement');
    }

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

        $this->assertEquals('Taylor', $mock->first_name);
        $this->assertEquals('Otwell', $mock->last_name);
        $this->assertEquals('Laravel', $mock->stack);

        $this->assertInternalType('array', $mock->getProperties());

        $this->assertArrayHasKey('first_name', $mock->getProperties());
        $this->assertArrayHasKey('last_name', $mock->getProperties());
        $this->assertArrayHasKey('stack', $mock->getProperties());

        $this->assertInstanceOf('Florence\Model', $mock);
        $this->assertArrayHasKey('first_name', $mock->getProperties());
        $this->assertArrayHasKey('last_name', $mock->getProperties());
        $this->assertArrayHasKey('stack', $mock->getProperties());
        $this->assertNotEmpty($mock->getProperties());
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
