<!DOCTYPE html>
<html lang="en">
	<head>
    <meta http-equiv="content-type" content="text/php; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="" />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
		<meta name="robots" content="index, follow" />
    <title>About Me</title>
	</head>
  <body>
    <?php include 'header.php'?>
    <!--======================Page Container START===================================-->
      <div class="container">
      <?php
      $user = $_SESSION['fbid'];
      require 'api/db_config.php';
      $sql = "SELECT * FROM users where fb_id = $user";
      $result = $mysqli->query($sql);
      while($row = $result->fetch_assoc())
      {
        extract($row);
        $pa = $cover.'&oe='.$oe;
      ?>
      <!-- Timeline
      ================================================= -->
        <div class="timeline">
          <div class="timeline-cover" <?php if($cover !=""){ echo "style='background-image: url($pa)';";} ?>>
            
            <!--Timeline Menu for Large Screens-->
            <div class="timeline-nav-bar hidden-sm hidden-xs">
              <div class="row">
                <div class="col-md-3">
                  <div class="profile-info">
                    <img src=<?php echo  "http://graph.facebook.com/$user/picture?type=large"; ?> alt="" class="img-responsive profile-photo" />
                    <h3><?php echo $name; ?></h3>
                    <!-- <p class="text-muted">Creative Director</p> -->
                  </div>
                </div>
                <div class="col-md-9">
                  <ul class="list-inline profile-menu">
                    <!--<li><a href="edit-profile.php" class="active">About</a></li>-->
                    <li><a href="#">Friends</a></li>
                  </ul>
                  <ul class="follow-me list-inline">
                    <!-- <li>1,299 people following her</li> -->
                    <li><a href="edit-profile.php"><button class="btn-primary">Edit Profile</button></a></li>
                  </ul>
                </div>
              </div>
            </div><!--Timeline Menu for Large Screens End-->

            <!-- Timeline Menu for Small Screens-->
            <!-- <div class="navbar-mobile hidden-lg hidden-md">
              <div class="profile-info">
                
                <img src="" alt="" class="img-responsive profile-photo" />
                <h4>Sarah Cruiz</h4>
                <p class="text-muted">Creative Director</p>
              </div>
              <div class="mobile-menu">
                <ul class="list-inline">
                  <li><a href="timline.html">Timeline</a></li>
                  <li><a href="timeline-about.html" class="active">About</a></li>
                  <li><a href="timeline-album.html">Album</a></li>
                  <li><a href="timeline-friends.html">Friends</a></li>
                </ul>
                <button class="btn-primary">Add Friend</button>
              </div> -->
            </div><!--Timeline Menu for Small Screens End -->

          </div>
          <div id="page-contents">
            <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-7">

                <!-- About
                ================================================= -->
                <div class="about-profile">
                  <div class="about-content-block">
                    <h4 class="grey"><i class="ion-ios-information-outline icon-in-title"></i>Personal Information</h4>
                    <p><?php echo $about; ?></p>
                  </div>
                    <div class="row">  
                  <div class="about-content-block col-xs-6">
                    <h4 class="grey"><i class="fa fa-user-circle-o icon-in-title"></i>Name</h4>
                    <p><?php echo $first_name; ?>&nbsp;<?php echo $last_name; ?></p>
                  </div>
                  <div class="about-content-block col-xs-6">
                    <h4 class="grey"><i class="fa fa-envelope-o icon-in-title"></i>My email</h4>
                    <p><?php echo $email; ?></p>
                  </div>
                    </div>
                    <div class="row">  
                  <div class="about-content-block col-xs-6">
                    <h4 class="grey"><i class="fa fa-birthday-cake icon-in-title"></i>Date of Birth</h4>
                    <p><?php echo $birth_date; ?></p>
                  </div>
                  <div class="about-content-block col-xs-6">
                    <h4 class="grey"><i class="ion-ios-location-outline icon-in-title"></i>Location</h4>
                    <p><?php echo $nationality; ?></p>
                  </div>
                    </div>
                  <div class="about-content-block">
                    <h4 class="grey"><i class="ion-ios-briefcase-outline icon-in-title"></i>Work Experiences</h4>
                     <div class="organization">
                        <span class="text-grey"><?php echo $work_experiences; ?></span>
                    </div>
                  </div>  
                </div>
              </div>
              <div class="col-md-2 static about-profile">
                <div id="sticky-sidebar">
                  <div class="about-content-block">
                    <h4 class="grey"><i class="ion-ios-heart-outline icon-in-title"></i>Interests</h4>
                    <ul class="interests list-inline">
                      <li><span class="int-icons" title="Bycycle riding"><i class="icon ion-android-bicycle"></i></span></li>
                      <li><span class="int-icons" title="Photography"><i class="icon ion-ios-camera"></i></span></li>
                      <li><span class="int-icons" title="Shopping"><i class="icon ion-android-cart"></i></span></li>
                      <li><span class="int-icons" title="Traveling"><i class="icon ion-android-plane"></i></span></li>
                      <li><span class="int-icons" title="Eating"><i class="icon ion-android-restaurant"></i></span></li>
                    </ul>
                  </div>
                  <div class="about-content-block">
                    <h4 class="grey"><i class="ion-ios-chatbubble-outline icon-in-title"></i>Language</h4>
                      <ul>
                        <li><a href="">Russian</a></li>
                        <li><a href="">English</a></li>
                      </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
    </div>
  
    <!--======================Page Container STOP====================================-->
    <?php include 'footer.php' ?>

  </body>
</php>
