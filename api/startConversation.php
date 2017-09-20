<?php
session_start();
$user = $_SESSION['userid'];
require 'db_config.php';
if (isset($_REQUEST['q'])) {
    $que = $_REQUEST['q'];
    $sql = "SELECT f.*, u.fb_id,u.name,u.cover as ucover,u.oe as uoe FROM friend_list f, users u where f.friend_id=u.user_id and f.user_id = $user and u.name like '$que%'";
    $result = $mysqli->query($sql);
    while($row = $result->fetch_assoc()){
        extract($row);
        $msgid = base64_encode($friend_id);
        echo " <li>
        <a href='profile.php?id=$id'><img style='height: 50px;
        width: 50px;
        border-radius: 50px;
        margin: 0px 10px 0px 0px;' src='http://graph.facebook.com/$fb_id/picture?type=large' />$name <a href='messages.php?id=$msgid'>Message</a></a></li>";
    }

}

?>