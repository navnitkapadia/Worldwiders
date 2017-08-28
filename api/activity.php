<?php 
require 'db_config.php';
session_start();
if(isset($_SESSION['userid'])){
    $userid = $_SESSION['userid'];
    $time=time();
    $sql = "UPDATE users SET lastactivity=now() WHERE user_id = $userid"; 
    $result = $mysqli->query($sql);
    if($result){
        echo 'online';
    }
}
?>
