<?php


require "vendor/autoload.php";

use Florence\DatabaseConnector;

$cxn = new DatabaseConnector();

echo $cxn->connect();



