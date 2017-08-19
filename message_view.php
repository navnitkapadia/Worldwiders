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
  $r = array();
  while($row = $result->fetch_array())
  {
	  $r[] = $row;
  }
  echo json_encode($r);
}

?>