<?php
include_once("../api/db_config.php");

$group_id = $_GET['id'];

echo $group_id;

$query = "delete from peoples_group where id=$group_id";
echo $query;
$result=$mysqli->query($query);

header("Location:grouplist.php");
?>