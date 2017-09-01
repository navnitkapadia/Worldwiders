<?php
include 'header.php';
$userId = $_SESSION['fbid'];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $update = "update event set user_id=CONCAT(user_id, ',', '$userId') where id=" . $id . "";
    $result = $mysqli->query($update);
    header('Location:home.php');
}

if(isset($_GET['gid'])){
    $group_Id = $_GET['gid'];
    $update = "insert into group_member (user_id,group_id) VALUES('$userId','$group_Id')";
    $result = $mysqli->query($update);
    header('Location:home.php');
}
?>