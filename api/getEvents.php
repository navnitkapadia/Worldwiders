<?php 
require 'db_config.php';
session_start();
if(isset($_REQUEST['date-select'])){
    $select = date('Y-m-d', strtotime($_REQUEST['date-select']));
    $date = "SELECT e.*,u.name,u.fb_id FROM event e, users u where start_date >= $select and u.user_id = e.created_by";
} else {
    $date = "SELECT e.*,u.name,u.fb_id FROM event e, users u where u.user_id = e.created_by";
}
 $result = $mysqli->query($date);

 while($row = $result->fetch_assoc()){
    extract($row);

    $myid = $_SESSION['userid'];
    $checkisfriend= "select * from friend_list where user_id = $myid and friend_id = $created_by";
    $result1 = $mysqli->query($checkisfriend);
    if(mysqli_num_rows($result1) >  0){
            $isfriend = "Friend";
            $url = "profile.php?id=$created_by";
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
          <img style='width:242px;' src=$src alt='Group image' class='img-responsive post-image' />
      </div>
      <div class='media-info'>
          <div class='reaction'>
              <h4><a href='events-details.php?id=$id'></a></h4>
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

?> 