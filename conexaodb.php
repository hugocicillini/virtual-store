<?php

define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'deni_store');

$link = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($link->connect_errno) {   
    printf("Connect failed: %s\n", $link->connect_error);   
    exit();   
}
