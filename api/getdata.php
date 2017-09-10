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
  if(isset($languages)){
    $lang = explode(",", $languages);
      for($i = 0; $i < sizeof($lang); $i++){
        echo "<li><a href='#'>". $lang[$i] ."</a></li>";
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
            echo "<li><span class='int-icons' title='$interest_name'><i class='$interest_icon'></i></span></li>";
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