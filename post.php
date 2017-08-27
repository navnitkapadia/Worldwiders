<?php

include 'header.php';
require 'api/db_config.php';

if (isset($_POST['post'])) {
    $event_Id = $_GET['id'];
    $comment = $_POST['texts'];
    $user_id = $_SESSION['userid'];
    $sql = "INSERT INTO event_comment (comment, event_id,user_id) VALUES ('$comment','$event_Id','$user_id')";
    $result = $mysqli->query($sql);
    if ($result) {
        header("Location:event-details.php?id=$event_Id");
    } else {
        exit('123');
    }
}

if(isset($_POST['comment'])){
    $group_Id = $_GET['gid'];
    $desc = $_POST['desc'];
    $user = $_SESSION['userid'];
    $date = new DateTime();
    $created_at = $date->format('Y-m-d H:i:s');
    $sql = "INSERT INTO topic_desc (group_id, comment,user_id,created_at) VALUES ('$group_Id','$desc','$user','$created_at')";
    $result = $mysqli->query($sql);
    if ($result) {
        header("Location:group-details.php?id=$group_Id");
    } else {
        exit('123');
    }
}
?>