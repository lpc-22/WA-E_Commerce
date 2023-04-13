<?php
define('hostname', 'localhost');
define('user', 'root');
define('password', 'root');
define('database', 'COMP3421');

 
// Connect to the database
try{
    $link = mysqli_connect(hostname, user, password, database);
} catch(Exception $e){
    die("<h1>Server offline</h1>");
}

if($link === false){
    die("Fail to connect" . mysqli_connect_error());
}