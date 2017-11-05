<?php

require 'db_config.php';
session_start();
$user = $_SESSION['userid'];
$id = $_REQUEST['id'];
if(isset($_REQUEST['date-select'])){
    $select = date('Y-m-d', strtotime($_REQUEST['date-select']));    
    $eventsql = "SELECT e.*,u.name,u.fb_id FROM event e, users u where u.user_id = e.created_by and start_date = '$select' and e.gruop_id = $id";
} else {
    $current = new DateTime(); 
    $now = $current->format('Y-m-d');
    $eventsql = "SELECT e.*,u.name,u.fb_id FROM event e, users u where u.user_id = e.created_by and start_date >= '$now' and e.gruop_id = $id";
}
$eventresult = $mysqli->query($eventsql);
$number_of_rows = mysqli_num_rows($eventresult);
if($number_of_rows > 0){
while ($eventrow = $eventresult->fetch_assoc()) {
    extract($eventrow);
    $starting = date('d.m.Y , l', strtotime($start_date));
  
    echo  "
    
    
    
    <div class='col-sm-12'>
    <div class='event-box'>
        <div class='col-sm-3 img-wrapper' style='background-image: url('upload/$file')'>
        </div>
        <div class='col-sm-7 media-info'>
            <div class='reaction'>
                <h4><a href='event-details.php?id=$id'>$event</a></h4>
                <p>$starting &nbsp; - Starting from:  $start_time  </p>
            </div>
        </div>
        <div class='col-sm-2 user-info'>
            <img src='http://graph.facebook.com/$fb_id/picture?type=large' alt='' class='profile-photo-sm'>
            <div class='user'>
                <h6><a href='profile.php?id=$created_by' class='profile-link'>$name</a></h6>
            </div>
        </div>
    </div>
  </div>
    
    
    
    ";
}
} else {
    echo "No event found.";
}
?>