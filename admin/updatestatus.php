<?php
include_once("../api/db_config.php");

$user_id = $_GET['user_id'];
$status = $_GET['status'];

echo $user_id;

$query = "update users set status=$status where user_id=$user_id";
echo $query;
$result=$mysqli->query($query);

header("Location:userlist.php");
?>