<?php

define('DB_NAME', 'lucaspfava_db');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

$pdostring = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
if (!$connection = new PDO($pdostring, DB_USER, DB_PASSWORD))
{
    die("Failed to connect");
}