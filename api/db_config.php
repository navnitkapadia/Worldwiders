<?php
$username = "root"; //mysql username
$password = ""; //mysql password
$hostname = "localhost"; //hostname
$databasename = 'worldwiders'; //databasename

//connect to database
$mysqli = new mysqli($hostname, $username, $password, $databasename);

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

?>