<?php

/**
 * Created by Florence Okosun.
 * Date: 11/1/2015
 * Time: 11:31 AM
 */

require "vendor/autoload.php";

use Florence\Car;
use Florence\User;
//
    //insert and save
$user = new User();
//$user->first_name = "Prosper";
//$user->last_name = "Otemuyiwa";
//$user->stack = "Ninja";
//
//$user->save();
//print_r($user);

//    //find
//$user_ = User::find(8);
//print_r($user_);

$user = User::getAll();
var_dump($user);



//$car = Car::destroy(22);
//
//var_dump($car);

//$car = Car::find(3);
//print_r($car);
//$car = new Car();
//$car->brand = "buses";
//$car->color = "tilker";
//$car->price = "6000";
//
//$car->save();
//
//var_dump($car);








