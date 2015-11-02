<?php


require "vendor/autoload.php";

use Florence\User;


//$user = User::find(4);
////$user->first_name = "Prosper";
//
//print_r($user);

$user = new User();
$user->first_name = "Shneal";
$user->last_name = "Obama";
$user->stack = "None";

$user->save();







