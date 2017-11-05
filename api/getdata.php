<?php
require 'db_config.php';
session_start();
if (isset($_REQUEST['action'])) {
  switch ($_REQUEST['action']) {
    case 'lang':
      givelang($mysqli);
      break;
      case 'intrest':
      getintrest($mysqli);
      break;
      case 'selectint':
      selectint($mysqli);
      break;
      case 'deleteint':
      deleteint($mysqli);
      break;
      case 'deletelang':
      deletelang($mysqli);
      break;
  }
}
function deleteint($mysqli){
  $id =  $_REQUEST['id'];
  $userid = $_SESSION['userid'];
  $oldint = $_REQUEST['oldint'];
  $int = explode(",", $oldint);
   unset($int[$id]); 
   $new = implode(",",$int);
  $sql = "UPDATE users SET interest_ids='$new' WHERE user_id = $userid";
  $result = $mysqli->query($sql); 
  if ($result) {
    header('Location:../edit-profile.php?msg=success');
        exit;
  } 
}
function  deletelang($mysqli){
  $id =  $_REQUEST['id'];
  $userid = $_SESSION['userid'];
  $old_lang = $_REQUEST['oldlang'];
  $lang = explode(",", $old_lang);
  unset($lang[$id]);   
  $new = implode(",",$lang);
  $sql = "UPDATE users SET languages='$new' WHERE user_id = $userid";
  $result = $mysqli->query($sql);
  if ($result) {
    header('Location:../edit-profile.php?msg=success');
        exit;
  } 
}
function givelang($mysqli){
  $userid = $_SESSION['userid'];
  if(isset($_REQUEST['userid'])){
    $see = $_REQUEST['userid'];
    $sql = "SELECT languages FROM users WHERE user_id = $see";
  } else {
    $sql = "SELECT languages FROM users WHERE user_id = $userid";
  }
  $result = $mysqli->query($sql);
  $row = $result->fetch_assoc();
  extract($row);
  if(isset($languages) && $languages !== ""){
    $lang = explode(",", $languages);
      for($i = 0; $i < sizeof($lang); $i++){
        echo "<li>". $lang[$i] ."  <a href='api/getdata.php?action=deletelang&oldlang=$languages&id=$i'><i style='
        float: right;
        cursor: pointer;
    ' class='fa fa-times' aria-hidden='true'></i> </a></li>";
      }
    }
    echo "<input type='hidden' id='oldlang' value='$languages' />";
}

function getintrest($mysqli){
  $userid = $_SESSION['userid'];
  if(isset($_REQUEST['userid'])){
    $see = $_REQUEST['userid'];
    $sql = "SELECT interest_ids FROM users WHERE user_id = $see"; 
  } else {
    $sql = "SELECT interest_ids FROM users WHERE user_id = $userid"; 
  }
  $result = $mysqli->query($sql); 
  $row = $result->fetch_assoc();
   extract($row);
   if(isset($interest_ids)){
    $int = explode(",", $interest_ids);
      for($i = 0; $i < sizeof($int); $i++){
        $sqlin = "SELECT * FROM interests WHERE interest_id =". $int[$i]; 
        $result1 = $mysqli->query($sqlin);
        if($result1){
          while($row1 = $result1->fetch_assoc()){
            extract($row1);

            echo "<li><i class='$interest_icon' aria-hidden='true'></i> $interest_name 
            <a href='api/getdata.php?action=deleteint&oldint=$interest_ids&id=$i'><i style='
            cursor: pointer;
            margin-left: 50px;
        ' class='fa fa-times' aria-hidden='true'></i></a></li>";
          }
        }
      }
    }
    echo "<input type='hidden' id='oldinte' value='$interest_ids' />";
}

function selectint($mysqli){
  $que = $_REQUEST['q'];
  $sqlin = "SELECT * FROM interests WHERE interest_name like '$que%' ORDER BY interest_name"; 
  $result1 = $mysqli->query($sqlin);
  while($row1 = $result1->fetch_assoc()){
    $interest[] = $row1;
  }
  echo json_encode($interest);
}
?>