<?php
require 'db_config.php';

$sql = "SELECT * FROM peoples_group";

$result = $mysqli->query($sql);

  while($row = $result->fetch_assoc()){

     $json[] = $row;

  }

  $data['data'] = $json;

$result =  mysqli_query($mysqli,$sqlTotal);

$data['total'] = mysqli_num_rows($result);

echo json_encode($data);

?>