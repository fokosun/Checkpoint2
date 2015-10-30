<?php

namespace Florence\Test;

use Florence\Car;

class CarTest extends \PHPUnit_Framework_TestCase
{

    protected function setUp() {
        $this->car = new Car();
    }

    public function testConnect() {
        dd($this->connect());
    }

}
