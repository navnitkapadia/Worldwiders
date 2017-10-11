<?php

require 'db_config.php';
session_start();
$user = $_SESSION['userid'];
$id = $_REQUEST['id'];
if(isset($_REQUEST['date-select'])){
$select = date('Y-m-d', strtotime($_REQUEST['date-select']));    
$eventsql = "SELECT * FROM event where start_date = '$select' and gruop_id = $id";
$eventresult = $mysqli->query($eventsql);
echo "<h4>Event</h4>";
$number_of_rows = mysqli_num_rows($eventresult);
if($number_of_rows > 0){
while ($eventrow = $eventresult->fetch_assoc()) {
    extract($eventrow);
    $starting = date('d.m.Y , l', strtotime($start_date));
    echo "<img src='upload/$file' alt='user' class='profile-photo-md pull-left' />
          <div class='post-detail'>
            <div class='user-info'>
                    <h5><a href='event-details.php?id=$id' class='profile-link'>$event</a></h5>
                    <p class='text-muted'>$starting &nbsp; Starting from: $start_time</p>
            </div>
          </div>";
}
} else {
    echo "No event found.";
}
}
?>