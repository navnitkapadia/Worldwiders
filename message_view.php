<?php

require 'api/db_config.php';
if (isset($_REQUEST['action'])) {
   switch ($_REQUEST['action']) { 
     case 'view':	
      view($mysqli);
      break;
  }
}

function view($mysqli){
  $sql = "select * from chat";
  $result = $mysqli->query($sql);
  $array = array();
  $i = 0;
  while($row = $result->fetch_array())
  {
	  $array[$i]['id']= $row['id'];
      $array[$i]['message']=$row['message'];
	  $array[$i]['created_at']= $row['created_at'];
      $array[$i]['sender']=$row['sender'];
	  $array[$i]['received']= $row['received'];
      $i++;
	  //extract($row);
	  //$r[] = $row;
  }
  //exit;
  echo json_encode($array);
}

?>