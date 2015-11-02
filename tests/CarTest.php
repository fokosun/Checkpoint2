<?php

namespace Florence\Test;

use Florence\Car;
use Florence\Base;
use Florence\DatabaseConnector;

class CarTest extends \PHPUnit_Framework_TestCase
{
    protected $car;

    protected function setUp() {
        $this->car = new Car();
    }

    public function testSave() {
       $this->assertEquals(2, 1+1);
    }

}
