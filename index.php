<?php


require "vendor/autoload.php";

use Florence\User;


$user = new User();


$user->first_name = "Florence";
$user->last_name = "Okosun";

$user->save();





