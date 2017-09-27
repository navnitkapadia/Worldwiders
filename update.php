<?php
session_start();
include 'api/db_config.php';
$userId = $_SESSION['userid'];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $update = "update event set user_id=CONCAT(user_id, '$userId', ',') where id=" . $id . "";
    $result = $mysqli->query($update);
    header('Location:events.php');
}

if(isset($_GET['gid'])){
    $group_Id = $_GET['gid'];
    $update = "insert into group_member (user_id,group_id) VALUES('$userId','$group_Id')";
    $result = $mysqli->query($update);
    header("Location:group-details.php?id=$group_Id");
}
?>