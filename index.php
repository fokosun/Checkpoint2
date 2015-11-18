<?php

// /**
//  * Created by Florence Okosun.
//  * Date: 11/1/2015
//  * Time: 11:31 AM
//  */

require "vendor/autoload.php";

use Florence\User;

// $user = new User();
// $user->first_name = "Nadayar";
// $user->last_name = "Enegesi";
// $user->stack = "Trainer";
// $user->save();

//record does not exist
// $user = User::find(100);
// print_r($user);

// record exist
// $user = User::find(5);
// print_r($user);

$user = User::find(46);
$user->id = 100;
$user->first_name = "Nadayar";
$check = $user->save();
// echo ! $check ? 'successfully updated' : 'failed to update' ;

// echo"<pre>";
// print_r(User::getAll());
// echo"</pre>";

// record exist
// $user = User::destroy(420);
// print_r($user);

// record does not exist
// $user = User::destroy(50);
// print_r($user);
