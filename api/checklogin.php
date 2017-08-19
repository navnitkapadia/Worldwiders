<?php 
require 'db_config.php';
session_start();
$userid = $_REQUEST['userid'];
$accesstoken = $_REQUEST['accesstoken'];

$sql = "SELECT user_id FROM users where user_id= $userid"; 

$result = $mysqli->query($sql);

if($result){
    $_SESSION['userid'] = $userid;
    $_SESSION['userid'] = $accesstoken;
}

echo json_encode(mysqli_num_rows($result));
?>