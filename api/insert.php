<?php
include '../header.php';
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
    case 'addfriend':
      addfriend($mysqli);
      break;
    case 'eventslist':
      eventslist($mysqli);
      break;
  
  }
}
function make_group($mysqli){
  $id = $_REQUEST['id'];
  $title = $_REQUEST['title'];
  $description = $_REQUEST['description'];
  $group_image = file_upload();
  $userid = $_SESSION['userid'];
  $mo_name = $_REQUEST['moname'];
  $moderator = $_REQUEST['moderator'];
  if(!$id){
    $sql="UPDATE peoples_group SET title=''$title',`description`='$description',`file`= '$group_image',`admin_id`=$userid ,`moderator_id`=$moderator,`mo_name`='$mo_name' WHERE id=$id";
  }else{
    $sql = "INSERT INTO peoples_group (title,description,file,admin_id,moderator_id,mo_name) VALUES ('$title','$description','$group_image',$userid,$moderator,'$mo_name')";
  }
  
  $result = $mysqli->query($sql);
  if ($result) {
    header('Location:../admin/creategroup.php?msg=success');
        exit;
  } else {
    header("Location:../admin/creategroup.php?msg=failed");
      exit;
  }
}
function new_event($mysqli){
  $evname = $_REQUEST['event-name'];
  $formdate = $_REQUEST['event-date'];
  $date = new DateTime();
  $create_at = $date->format('Y-m-d H:i:s');
  $event_start = date("Y-m-d", strtotime($_REQUEST['event-date']));
  $time = $_REQUEST['event-time'];
  $locname = $_REQUEST['lname'];
  $locadd = $_REQUEST['ladd'];
  $website = $_REQUEST['website'];
  $maxg = $_REQUEST['max-member'];
  $description = $_REQUEST['description'];
  $createdBy = $_SESSION['fbid'];
  $event_image = file_upload();

  $sql = "INSERT INTO event(event, location_name, location_address, website, file, description, max_limit, created_at, created_by,start_date,start_time) 
                    VALUES ('$evname','$locname','$locadd','$website','$event_image','$description',$maxg,'$create_at','$createdBy','$event_start','$time')";
  $result = $mysqli->query($sql);
  if ($result) {
        header('Location:../home.php?msg=success');
        exit;
  } else {
      header('Location:../home.php?msg=failed');
      exit;
  }
}
function addfriend($mysqli){
    $user_id = $_SESSION['userid'];
    $friend_id = $_REQUEST['friendid'];
    $time=time();
    $sql = "INSERT INTO friend_list (user_id, friend_id, time) VALUES ($user_id,$friend_id,$time)";
    $result = $mysqli->query($sql);
    if ($result) {
        header('Location:../friends.php?msg=success');
    } else {
      header('Location:../friends.php?msg=failed');
      exit;
    }
}
function eventslist($mysqli){
    $select = date('Y-m-d', strtotime($_REQUEST['date-select']));
    $date = "SELECT e.*,u.name,u.fb_id FROM event e, users u where start_date = $select";
    $result = $mysqli->query($date);
    $array = array();
    $i = 0;
    while($row = $result->fetch_assoc()){
      $array[$i]['id']= $row['id'];
      $array[$i]['file']=$row['file'];
      $array[$i]['fb_id']= $row['fb_id'];
      $array[$i]['name']=$row['name'];
      $array[$i]['event']= $row['event'];
      $array[$i]['start_date']= $row['start_date'];
      $array[$i]['start_time']= $row['start_time'];
      $array[$i]['event']= $row['event'];
      $array[$i]['created_by']= $row['created_by'];
      $i++;
    }
    echo json_encode($array);
}
function login($mysqli){
  session_start();
  $name = $_REQUEST['name'];
  $fname = $_REQUEST['first_name'];
  $lname = $_REQUEST['last_name'];
  $email = $_REQUEST['email'];
  $cover = $_REQUEST['cover'];
  $oe = $_REQUEST['oe'];
  $userid = $_REQUEST['userid'];
  $location = $_REQUEST['location'];
  $nationality = $_REQUEST['nationality'];
  $birthdate = date("y-m-d", strtotime($_REQUEST['birthdate']));
  
  $sql = "SELECT * FROM users where user_id = '$userid'"; 
  $result = $mysqli->query($sql);
  $row_cnt = $result->num_rows;
  $row = $result->fetch_assoc();
  if($row_cnt == 0){
    $sql = "INSERT INTO users (name,first_name,last_name,email,cover,oe,fb_id,nationality,location,birth_date,status,role_id) 
    VALUES ('$name','$fname','$lname','$email','$cover','$oe','$userid','$nationality','$location','$birthdate',1,2)";
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
        $random = rand(10,8956);
        if (in_array($file_ext, $expensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }
        
        if (empty($errors) == true) {
          move_uploaded_file($file_tmp, "../upload/$random-$random-$random-$file_name") or die('error in uploading files');
            
        } else {
            print_r($errors);
        }
        return "$random-$random-$random-$file_name";
    }
}
?>
