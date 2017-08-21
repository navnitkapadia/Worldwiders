<?php
require 'api/db_config.php';
if (isset($_REQUEST['action'])) {
   switch ($_REQUEST['action']) {  
     case 'chat':
      chat($mysqli);
      break;
  }
}

function chat($mysqli){
  $message = $_REQUEST['message'];
  $created_at = date("Y-m-d H:i:s");
  $sender = 1;
  $received = 2;
  $sql = "INSERT INTO chat (message,created_at,sender,received) VALUES ('$message', '$created_at', '$sender','$received')";
  $result = $mysqli->query($sql);
  if ($result) {
        header('Location:messages.php?msg=success');
  } else {
      header('Location:messages.php?msg=failed');
  }
}

?>