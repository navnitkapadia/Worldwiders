<?php
session_start();
include 'api/db_config.php';
if (isset($_REQUEST['action'])) {
  switch ($_REQUEST['action']) {
    case 'topic_desc':
      topic_desc($mysqli);
      break;
    case 'like':
      like($mysqli);
      break;
    case 'dislike':
      dislike($mysqli);
      break;
    case 'event-post':
      eventpost($mysqli);
      break;
    case 'comment':
      comment($mysqli);
      break;
  }
}

function eventpost($mysqli){
    $event_Id = $_REQUEST['id'];
    $comment = $_REQUEST['texts'];
    $user_id = $_SESSION['userid'];
    $sql = "INSERT INTO event_comment (comment, event_id,user_id) VALUES ('".addslashes($comment)."','$event_Id','$user_id')";
    $result = $mysqli->query($sql);
    if ($result) {
        echo json_encode('success');
    } else {
        echo json_encode('faild');
    } 
}

function comment($mysqli){
    $event = $_REQUEST['id'];
    $com = "SELECT event_comment.comment,users.fb_id,users.name from event_comment,users where event_comment.event_id=$event and event_comment.user_id = users.user_id";
    $result1 = $mysqli->query($com);
    $array = array();
    $i = 0;
    while ($row1 = $result1->fetch_assoc()) {
        extract($row1);
        echo "<p id='comment'><img src='http://graph.facebook.com/$fb_id/picture?type=large' alt='' class='profile-photo-sm' />&nbsp;<a class='profile-link'>$name</a>&nbsp;&nbsp;$comment</p>";
    }
}

if (isset($_POST['post'])) {
    $event_Id = $_GET['id'];
    $comment = $_POST['texts'];
    $user_id = $_SESSION['userid'];
    $sql = "INSERT INTO event_comment (comment, event_id,user_id) VALUES ('".addslashes($comment)."','$event_Id','$user_id')";
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
    $sql = "INSERT INTO topic_desc (group_id,topic_id,comment,user_id,created_at) VALUES ('$group_Id','$topic_id','".addslashes($desc)."','$user','$created_at')";
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
    $sql = "INSERT INTO group_topic (topic,description,group_id,user_id,created_at) VALUES ('".addslashes($topic)."','".addslashes($desc)."','$group_Id','$user','$created_at')";
    $result = $mysqli->query($sql);
    if ($result) {
        header("Location:group-details.php?id=$group_Id");
    } else {
        exit('Something Wrong');
    }
}
function like($mysqli){
    $id = $_REQUEST['id'];
    $user_id = $_SESSION['userid'];
    $like = $_REQUEST['like'];
    $counter = $like + 1 ;
    $like_dislike = 0;
    $sql1 = "UPDATE group_topic SET topic_like = $counter where id = $id";
    $sql = "INSERT INTO group_like (topic_id, user_id,like_dislike) VALUES ('$id','$user_id','$like_dislike')";
    $result1 = $mysqli->query($sql1);
    $result = $mysqli->query($sql);
    if($result && $result1){
        echo $counter;
    } else {
        echo json_encode('faild');
    }
}
function dislike($mysqli){
    $id = $_REQUEST['id'];
    $user_id = $_SESSION['userid'];
    $dislike = $_REQUEST['dislike'];
    $counter = $dislike + 1 ;
    $like_dislike = 1;
    $sql12 = "UPDATE group_topic SET dislike = $counter where id = $id";
    $sql123 = "INSERT INTO group_like (topic_id, user_id,like_dislike) VALUES ('$id','$user_id','$like_dislike')";
    $result123 = $mysqli->query($sql12);
    $result12 = $mysqli->query($sql123);
    if($result12 && $result123){
        echo $counter;
    } else {
        echo json_encode('faild');
    }
}
?>