<?php
 require 'db_config.php';
 if(isset($_REQUEST['q'])){
     $que = $_REQUEST['q'];
     $sql = "SELECT * FROM users WHERE name like '$que%' ORDER BY name"; 
     $result = $mysqli->query($sql);
     if(mysqli_num_rows($result) > 0 ){
         while($row = $result->fetch_assoc()){
             $moderetor[] = $row;
         }
         echo json_encode($moderetor);
     }
 }
?>  