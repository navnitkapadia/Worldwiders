<?php 
	session_start();
	if(!isset($_SESSION['fbid']) && !isset($_SESSION['userid'])){
		 header('Location: /');
	}
?>
    <!-- Newsfeed Common Side Bar Left
          ================================================= -->
          <?php 
          $fb_id=$_SESSION['fbid'];
          $fname=$_SESSION['fname'];
          $lname=$_SESSION['lname'];
          ?>
        <div class="profile-card">
            <img src=<?php echo "http://graph.facebook.com/$fb_id/picture?type=large"; ?> alt="user" class="profile-photo" />
            <h5><a href="profile.php" class="text-white"><?php echo $fname; ?>&nbsp;<?php echo $lname; ?></a></h5>
            <a href="" class="text-white"><i class="ion ion-android-person-add"></i>1,299 friends</a>
        </div><!--profile card ends-->
    <ul class="nav-news-feed">
        <li><i class="icon ion-ios-paper"></i><div><a href="home.php">My Newsfeed</a></div></li>
        <li><i class="icon ion-ios-people"></i><div><a href="events.php">Groups</a></div></li>
        <li><i class="icon ion-android-bar"></i><div><a href="groups.php">Events</a></div></li>
        <li><i class="icon ion-ios-people-outline"></i><div><a href="friends.php">Friends</a></div></li>
        <li><i class="icon ion-chatboxes"></i><div><a href="messages.php">Messages</a></div></li>
        <li><i class="icon ion-log-out"></i><div><a href="logout.php">logout</a></div></li>

    </ul><!--news-feed links ends-->
    