<?php 
require 'db_config.php';

$userid = $_REQUEST['userid'];

$sql = "SELECT user_id FROM users where user_id= $userid"; 

$result = $mysqli->query($sql);

echo json_encode(mysqli_num_rows($result));
?>