    <!-- Newsfeed Common Side Bar Left
          ================================================= -->
          <?php 

          $fname=$_SESSION['fname'];
          $lname=$_SESSION['lname'];
		 
          ?>

    
    <div class="page-header" id="banner">
					<h1>Welcome</h1>
					<p class="lead"><?php echo $fname; ?>&nbsp;<?php echo $lname; ?></p>
					<div class="list-group table-of-contents">
					  <a class="list-group-item" href="home.php"><i class="fa fa-bullhorn icon" aria-hidden="true"></i>News feed</a>
					  <a class="list-group-item" href="groups.php"><i class="fa fa-group icon" aria-hidden="true"></i>Groups</a>
					  <a class="list-group-item" href="events.php"><i class="fa fa-calendar icon" aria-hidden="true"></i>Events</a>
					  <a class="list-group-item" href="friends.php"><i class="fa fa-user icon" aria-hidden="true"></i>Friends</a>
					  <a class="list-group-item" href="messages.php"><i class="fa fa-comments-o icon" aria-hidden="true"></i>Messenger</a>
					  <a class="list-group-item" href="profile.php"><i class="fa fa-wrench icon" aria-hidden="true"></i>My profile</a>
					</div>
				</div>