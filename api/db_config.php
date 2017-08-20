<?php
//local
$username = "root"; //mysql username
$password = ""; //mysql password
$hostname = "localhost"; //hostname
$databasename = 'worldwiders'; //databasename

//server
// $username = "luiisnet_world"; //mysql username
// $password = "LNZ4lS8rt"; //mysql password
// $hostname = "localhost"; //hostname
// $databasename = 'luiisnet_world'; //databasename

//connect to database
$mysqli = new mysqli($hostname, $username, $password, $databasename);

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

?>