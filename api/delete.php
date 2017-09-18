<?php
include 'db_config.php';
session_start();
if (isset($_REQUEST['action'])) {
  switch ($_REQUEST['action']) {
    case 'add-lang':
      add_lang($mysqli);
      break;
  }
}
function add_lang($mysqli){
    $userid = $_SESSION['userid'];
    $lang = $_REQUEST['lang'];
    $old_lang = $_REQUEST['oldlang'];
    $new = $old_lang.','.$lang;
    $sql = "UPDATE users SET languages='$new' WHERE user_id = $userid"; 
    $result = $mysqli->query($sql);
}
?>