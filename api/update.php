<?php
include 'db_config.php';
session_start();
if (isset($_REQUEST['action'])) {
  switch ($_REQUEST['action']) {
    case 'add-lang':
      add_lang($mysqli);
      break;
      case 'add-int':
      add_intt($mysqli);
      break;
  }
}
function add_lang($mysqli){
    $userid = $_SESSION['userid'];
    $lang = $_REQUEST['lang'];
    $old_lang = $_REQUEST['oldlang'];
    if($old_lang == ""){
        $new = $lang;
    } else {
        $new = $old_lang.','.$lang;
    }
    $sql = "UPDATE users SET languages='$new' WHERE user_id = $userid"; 
    $result = $mysqli->query($sql);
}

function add_intt($mysqli){
    $userid = $_SESSION['userid'];
    $int = $_REQUEST['int'];
    $oldint = $_REQUEST['oldint'];
    if($oldint == ""){
        $new = $int;
    } else {
        $new = $oldint.','.$int;
    }
    $sql = "UPDATE users SET interest_ids='$new' WHERE user_id = $userid"; 
    $result = $mysqli->query($sql);
}
?>