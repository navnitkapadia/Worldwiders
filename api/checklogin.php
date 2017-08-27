<?php 
require 'db_config.php';
session_start();
$fbid = $_REQUEST['fbid'];
$accesstoken = $_REQUEST['accesstoken'];
$_SESSION['accesstoken'] = $accesstoken;

$sql = "SELECT * FROM users where fb_id=$fbid"; 

$result = $mysqli->query($sql);

if(mysqli_num_rows($result)){
    while($row = $result->fetch_assoc())
    {
      extract($row);
      $_SESSION['fbid'] = $fb_id;
      $_SESSION['userid'] = $user_id;
    }
}
echo json_encode(mysqli_num_rows($result));
?>