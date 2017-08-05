<?php

  require 'db_config.php';

  $id  = $_POST["id"];
  $post = $_POST;

  $sql = "UPDATE group SET title = '".$post['title']."'
    ,description = '".$post['description']."' 
    WHERE id = '".$id."'";

  $result = $mysqli->query($sql);

  $sql = "SELECT * FROM group WHERE id = '".$id."'"; 

  $result = $mysqli->query($sql);

  $data = $result->fetch_assoc();

  echo json_encode($data);

?>