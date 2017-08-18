<?php
require 'db_config.php';
if (isset($_REQUEST['action'])) {
  switch ($_REQUEST['action']) {
    case 'make-group':
      make_group($mysqli);
      break;
    case 'new-event':
      new_event($mysqli);
      break;
    case 'login':
      login($mysqli);
      break;
  }
}
function make_group($mysqli){
  $title = $_REQUEST['title'];
  $description = $_REQUEST['description'];
  $group_image = file_upload();
  $sql = "INSERT INTO peoples_group (title, description,file) VALUES ('$title', '$description', '$group_image')";
  $result = $mysqli->query($sql);
  if ($result) {
        header('Location:../make-group.php?msg=success');
        exit;
  } else {
      header('Location:../make-group.php?msg=failed');
      exit;
  }
}
function new_event($mysqli){
  $evname = $_REQUEST['event-name'];
  $formdate = $_REQUEST['event-date'];
  $created = date("y-m-d", strtotime($_REQUEST['event-date']));
  $locname = $_REQUEST['lname'];
  $locadd = $_REQUEST['ladd'];
  $website = $_REQUEST['website'];
  $maxg = $_REQUEST['max-member'];
  $description = $_REQUEST['description'];
  $event_image = file_upload();

  $sql = "INSERT INTO event(event, location_name, location_address, website, file, description, max_limit, created_at) 
                    VALUES ('$evname','$locname','$locadd','$website','$event_image','$description',$maxg,'$created')";
  $result = $mysqli->query($sql);
  if ($result) {
        header('Location:../event-registration.php?msg=success');
        exit;
  } else {
      header('Location:../event-registration.php?msg=failed');
      exit;
  }
}
function login($mysqli){
  session_start();
  $name = $_REQUEST['name'];
  $email = $_REQUEST['email'];
  $cover = $_REQUEST['cover'];
  $userid = $_REQUEST['userid'];
  $location = $_REQUEST['location'];
  $nationality = $_REQUEST['nationality'];
  $birthdate = date("y-m-d", strtotime($_REQUEST['birthdate']));
  
  $sql = "SELECT * FROM users where user_id = '$userid'"; 
  $result = $mysqli->query($sql);
  $row_cnt = $result->num_rows;
  $row = $result->fetch_assoc();
  if($row_cnt == 0){
    $sql = "INSERT INTO users (name,email,cover,user_id,nationality,location,birth_date,status,role_id) 
    VALUES ('$name','$email','$cover','$userid','$nationality','$location','$birthdate',1,2)";
    $result = $mysqli->query($sql);
  } 
}
function file_upload(){
  if (isset($_FILES['image'])) {
        $errors    = array();
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp  = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext  = strtolower(end(explode('.', $_FILES['image']['name'])));
        
        $expensions = array(
            "pdf",
            "txt",
            "doc",
            "jpg",
            "jpeg",
            "png",
			"txt"
        );
        
        if (in_array($file_ext, $expensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }
        
        if (empty($errors) == true) {
          move_uploaded_file($file_tmp, "../upload/$file_name") or die('error in uploading files');
          exit;
            
        } else {
            print_r($errors);
        }
        $random = rand(10,8956);
        return "$random-$random-$random-$file_name";
    }
}
?>