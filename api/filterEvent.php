<?php

require 'db_config.php';
session_start();
$user = $_SESSION['userid'];
if(isset($_REQUEST['date-select'])){
$select = date('Y-m-d', strtotime($_REQUEST['date-select']));    
$eventsql = "SELECT * FROM event where start_date = '$select'";
$eventresult = $mysqli->query($eventsql);
echo "<h4>Event</h4>";
while ($eventrow = $eventresult->fetch_assoc()) {
    extract($eventrow);
    $starting = date('d.m.Y , l', strtotime($start_date));
    echo "<img src='upload/$file' class='profile-photo-sm pull-left' />
	  <div>
          <h5><a href='event-details.php?id=$id'>$event</a></h5>
          <a class='text-green'>$starting</a><br>
          <a class='text-green'>Starting from: $start_time<a>
	  </div>";
}
}
?>