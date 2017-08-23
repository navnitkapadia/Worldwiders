<?php

require 'api/db_config.php';
if (isset($_REQUEST['action'])) {
    switch ($_REQUEST['action']) {
        case 'getData':
            getData($mysqli);
            break;
        case 'newmessage';
            newmessage($mysqli);
            break;
    }
}

function getData($mysqli) {
    $id = $_REQUEST['id'];
    $userid = $_REQUEST['userid'];
    $sql = "select * from chat";
    $result = $mysqli->query($sql);
    $array = array();
    $i = 0;
    while ($row = $result->fetch_array()) {
        $array[$i]['id'] = $row['id'];
        $array[$i]['message'] = $row['message'];
        $array[$i]['created_at'] = $row['created_at'];
        $array[$i]['sender'] = $row['sender'];
        $array[$i]['received'] = $row['received'];
        $i++;
        //extract($row);
        //$r[] = $row;
    }
    //exit;
    echo json_encode($array);
}

function newmessage($mysqli) {
    $message = $_REQUEST['message'];
    echo $message;
    $created_at = date("Y-m-d H:i:s");
    $received = $_REQUEST['id'];
    $sender = $_REQUEST['userid'];
    $sql = "INSERT INTO chat (message,created_at,sender,received) VALUES ('$message', '$created_at', '$sender','$received')";
    $result = $mysqli->query($sql);
    echo json_encode("success");
}

?>