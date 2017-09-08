<?php
require 'api/db_config.php';
session_start();
if($_GET['id']){
    $group = $_GET['group_id'];
    $id = $_GET['id'];
    $sql = "DELETE FROM group_topic WHERE id=$id";
    $result = $mysqli->query($sql);
    if($result){
        header("Location:group-details.php?id=$group");
    } else {
        header("Location:group-details.php?id=$group");
    }
}
?>