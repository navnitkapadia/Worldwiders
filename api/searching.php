<?php

require 'db_config.php';
$moderetor = array();
if (isset($_REQUEST['q']) && $_REQUEST['q'] != "") {
    $que = $_REQUEST['q'];
    if ($que == "") {
        return;
    }
    $sql = "SELECT u.user_id as id,u.name as name, u.fb_id as fb_id  FROM users u WHERE u.name like '$que%'";
    $sql_group = "select g.id as id,g.title as name FROM peoples_group g WHERE g.title like '$que%'";
    $sql_event = "select e.id as id,e.event as name FROM event e WHERE e.event like '$que%'";
    $result = $mysqli->query($sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $moderetor["users"][] = $row;
        }
    }
    $result = $mysqli->query($sql_group);
    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $moderetor["group"][] = $row;
        }
    }
    $result = $mysqli->query($sql_event);
    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $moderetor["event"][] = $row;
        }
    }

    if (isset($moderetor["group"])) {
        foreach ($moderetor["group"] as $gp) {
            $id = $gp['id'];
            $name = $gp['name'];
            echo "
          <li>   
            <a href='group-details.php?id=$id'>$name</a>
          </li>
         ";
        }
    }
    if (isset($moderetor["event"])) {
        foreach ($moderetor["event"] as $gp) {
            $id = $gp['id'];
            $name = $gp['name'];
            echo "  
            <li><a href='event-details.php?id=$id'>$name</a> </li>
         
         ";
        }
    }
    if (isset($moderetor["users"])) {
        foreach ($moderetor["users"] as $gp) {
            $id = $gp['id'];
            $name = $gp['name'];
            $fb_id = $gp['fb_id'];
            $msgid = base64_encode($id);
            echo "
            <li>
          <a href='profile.php?id=$id'><img style='height: 50px;
          width: 50px;
          border-radius: 50px;
          margin: 0px 10px 0px 0px;' src='http://graph.facebook.com/$fb_id/picture?type=large' />$name <a href='messages.php?id=$msgid'>Message</a></a></li>
         ";
        }
    }
    //echo json_encode($moderetor);
}
?>  