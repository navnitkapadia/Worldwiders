<?php

include 'header.php';
if (isset($_REQUEST['action'])) {
  switch ($_REQUEST['action']) {
    case 'topic_desc':
      topic_desc($mysqli);
      break;
  }
}

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

function topic_desc($mysqli){
    $group_Id = $_REQUEST['group'];
    $topic_id = $_REQUEST['topic'];
    $desc = $_REQUEST['comment'];
    $user = $_SESSION['userid'];
    $date = new DateTime();
    $created_at = $date->format('Y-m-d H:i:s');
    $sql = "INSERT INTO topic_desc (group_id,topic_id,comment,user_id,created_at) VALUES ('$group_Id','$topic_id','$desc','$user','$created_at')";
    $result = $mysqli->query($sql);
    if ($result) {
        //header("Location:group-details.php?id=$group_Id");
    } else {
        exit('Something Wrong');
    }
}

if(isset($_POST['add_topic'])){
    $group_Id = $_GET['id'];
    $user = $_SESSION['userid'];
    $date = new DateTime();
    $created_at = $date->format('Y-m-d H:i:s');
    $topic = $_REQUEST['topic-name'];
    $desc = $_REQUEST['description'];
    $sql = "INSERT INTO group_topic (topic,description,group_id,user_id,created_at) VALUES ('$topic','$desc','$group_Id','$user','$created_at')";
    $result = $mysqli->query($sql);
    if ($result) {
        header("Location:group-details.php?id=$group_Id");
    } else {
        exit('Something Wrong');
    }
}
?>