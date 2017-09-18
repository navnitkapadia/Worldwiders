<?php 
session_start();
require 'db_config.php';
if (isset($_REQUEST['action'])) {
  switch ($_REQUEST['action']) {
    case 'p':
      post_message($mysqli);
      break;
  }
}
function post_message($mysqli){
    if(isset($_REQUEST['message'])){
        $message = mysqli_real_escape_string($mysqli , $_REQUEST['message']);
        $conversation_id = mysqli_real_escape_string($mysqli, $_REQUEST['conversation_id']);
        $user_form = mysqli_real_escape_string($mysqli, $_REQUEST['user_form']);
        $user_to = mysqli_real_escape_string($mysqli, $_REQUEST['user_to']);
 
        //decrypt the conversation_id,user_from,user_to
        $time=time();
        $ip=$_SERVER['REMOTE_ADDR'];
        //insert into `messages`
        
        $quey = "INSERT INTO conversation_reply (user_id_fk,reply,ip,time,c_id_fk) 
        VALUES ('$user_form','$message','$ip','$time','$conversation_id')";
        $result = $mysqli->query($quey);
        if($result){
           $updatecontime="UPDATE `conversation` SET time ='$time' WHERE c_id ='$conversation_id'";
           $mysqli->query($updatecontime);
           echo 'posted';
        }
    }
}

?>