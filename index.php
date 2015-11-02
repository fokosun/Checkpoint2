<?php


require "vendor/autoload.php";

use Florence\User;


$user = new User();


$user->first_name = "Ibraheem";
$user->last_name = "Adeniyi";
$user->stack = "PHPLaravel";

$user->save();





