<?php

include_once("../api/db_config.php");

$group_id = $_GET['id'];

$file = $_GET['file'];
echo $group_id;

$query = "delete from peoples_group where id=$group_id";
echo $query;
$result = $mysqli->query($query);
if (file_exists("../upload/$file")) {
    unlink("$upload_dir/$file");
}
header("Location:grouplist.php");
?>