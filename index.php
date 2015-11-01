<?php


require "vendor/autoload.php";

use Florence\User;
use Florence\Car;
use Florence\Bicycle;

$user = new User();
$car = new Car();
$bicycle = new Bicycle();

echo $user->disconnect().' '.$car->disconnect().' '.$bicycle->disconnect();




