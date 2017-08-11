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
  $name = $_REQUEST['name'];
  $email = $_REQUEST['email'];
  $profile_pic = $_REQUEST['prfile-image'];
  
  $sql = "INSERT INTO users (firstname, email,file) VALUES ('$name','$email','$profile_pic')";
  $result = $mysqli->query($sql);

  if ($result) {
        header('Location:../login.php?msg=success');
         $data = $result->fetch_assoc();
        echo json_encode($data);
        exit;
  } else {
      header('Location:../login.php?msg=failed');
      exit;
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