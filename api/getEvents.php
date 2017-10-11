<?php 
require 'db_config.php';
session_start();
$current = new DateTime();
$now = $current->format('Y-m-d');
if(isset($_REQUEST['date-select'])){
    $select = date('Y-m-d', strtotime($_REQUEST['date-select']));
    if($now < $select){
        $date = "SELECT e.*,u.name,u.fb_id FROM event e, users u where start_date >= '$select' and u.user_id = e.created_by order by start_date";
        echo "<h1>Upcoming Events</h1>";
    } else {
        $date = "SELECT e.*,u.name,u.fb_id FROM event e, users u where start_date <= '$select' and u.user_id = e.created_by";
        echo "<h1>Past Events</h1>";
    }   
} else {
    $date = "SELECT e.*,u.name,u.fb_id FROM event e, users u where u.user_id = e.created_by and start_date >= '$now'";
    echo "<h1>Upcoming Events</h1>";
}

 $result = $mysqli->query($date);
 echo  "<div class='row js-masonry' data-masonry='{ 'itemSelector': '.grid-item', 'columnWidth': '.grid-sizer', 'percentPosition': true }'>";
 echo "<div class='grid-sizer'></div>";
 while($row = $result->fetch_assoc()){
    extract($row);

    $myid = $_SESSION['userid'];
    $group = array();
    $select = "SELECT friend_id from friend_list where user_id = $myid";
    $result5 = $mysqli->query($select);
    while($row5 = $result5->fetch_assoc()){
    extract($row5);
    $group[] = $friend_id;
    }
    if(in_array($created_by, $group)){
            $isfriend = "Friend";
            $url = "profile.php?id=$created_by";
    } elseif ($myid == $created_by) {
            $isfriend = "";
            $url = "";
    } else {
        $isfriend = "Add Friend";
        $url=  "api/insert.php?action=addfriend&friendid=$created_by";
    }  
    $src = '#';
    $starting = date('d.m.Y , l', strtotime($start_date));
   if ($file) {
       $src = "upload/$file";
   } else {
       $src = 'images/post-images/6.jpg';
   }
  
    echo  "<div class='grid-item col-md-4 col-sm-4'>
  <div class='media-grid'>
      <div class='img-wrapper'>
          <img style='width:242px;height:242px;' src=$src alt='Group image' class='img-responsive post-image' />
      </div>
      <div class='media-info'>
          <div class='reaction'>
              <h4><a href='event-details.php?id=$id'>$event</a></h4>
              <p>$starting &nbsp; - Starting from:  $start_time </p>
          </div>
          <div class='user-info'>
              <img src= 'http://graph.facebook.com/$fb_id/picture?type=large'  alt='' class='profile-photo-sm pull-left' />
              <div class='user'>
                  <h6><a href=$url class='profile-link'>$name</a></h6>
                  <a class='text-green' href=$url>$isfriend</a> 
              </div>
          </div>
      </div>
  </div>
</div>";
 }
echo "</div>"
?> 