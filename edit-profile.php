<!DOCTYPE php>
<php lang="en">
	<head>
    <meta http-equiv="content-type" content="text/php; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="" />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
		<meta name="robots" content="index, follow" />
		<title>Edit Profile</title>


	</head>
  <body>
    <?php include 'header.php'?>

    <!--======================Page Container START===================================-->

    <div class="container">
      <?php
      $user = $_SESSION['userid'];
      require 'api/db_config.php';
      $sql = "SELECT * FROM users where user_id = $user";
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
                    <h3><?php echo $first_name . $last_name; ?></h3>
                    <!-- <p class="text-muted">Creative Director</p> -->
                  </div>
                </div>
                <div class="col-md-9">
                  <ul class="list-inline profile-menu">
                    <li><a href="profile.php" class="active">About</a></li>
                    <li><a href="friends.php">Friends</a></li>
                  </ul>
                  <ul class="follow-me list-inline">
                    <!-- <li>1,299 people following her</li> -->
                    <li><button class="btn-primary">Add Friend</button></li>
                  </ul>
                </div>
              </div>
            </div><!--Timeline Menu for Large Screens End-->

          <!--Timeline Menu for Small Screens-->
          <div class="navbar-mobile hidden-lg hidden-md">
            <div class="profile-info">
              <img src="images/users/user-1.jpg" alt="" class="img-responsive profile-photo" />
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
            </div>
          </div><!--Timeline Menu for Small Screens End-->

        </div>
        <div id="page-contents">
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-7">

              <!-- Basic Information
              ================================================= -->
              <div class="edit-profile-container">
                <div class="block-title">
                  <h4 class="grey"><i class="icon ion-android-checkmark-circle"></i>Edit basic information</h4>
                  <div class="line"></div>
                  <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate</p>
                  <div class="line"></div>
                </div>
                <div class="edit-block">
                    <form name="basic-info" method="post" id="basic-info" class="form-inline">
                    <div class="row">
                      <div class="form-group col-xs-6">
                        <label for="firstname">First name</label>
                        <input id="firstname" class="form-control input-group-lg" type="text" name="firstname" title="Enter first name" placeholder="First name" value="<?php echo $first_name; ?>" />
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="lastname" class="">Last name</label>
                        <input id="lastname" class="form-control input-group-lg" type="text" name="lastname" title="Enter last name" placeholder="Last name" value="<?php echo $last_name; ?>" />
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="email">My email</label>
                        <input id="email" class="form-control input-group-lg" type="text" name="Email" title="Enter Email" placeholder="My Email" value="<?php echo $email; ?>" />
                      </div>
                    </div>
                    <div class="row">
                      <p class="custom-label"><strong>Date of Birth</strong></p>
                      <div class="form-group col-sm-6 col-xs-12">
                        <label for="date" class="sr-only"></label>
                        <input type="text" id="birth" name="birth" value="<?php echo $birth_date; ?>">
                      </div>
                    </div>
                    <div class="form-group gender">
                      <span class="custom-label"><strong>I am a: </strong></span>
                      <label class="radio-inline">
                        <input type="radio" name="optradio" checked>Male
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="optradio">Female
                      </label>
                    </div>
                    <div class="row">
                      <?php $city = explode(",", $location) ?>
                      <div class="form-group col-xs-6">
                        <label for="city"> My city</label>
                        <input id="city" class="form-control input-group-lg" type="text" name="city" title="Enter city" placeholder="Your city" value="<?php  echo $city[0]; ?>"/>
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="country">My country</label>
                        <input id="country" class="form-control input-group-lg" type="text" name="country" title="Enter country" placeholder="Your country" value="<?php  echo $city[1]; ?>"/>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="my-info">About me</label>
                        <textarea id="my-info" name="information" class="form-control" placeholder="Some texts about me" rows="4" cols="400"><?php echo $about ?></textarea>
                      </div>
                    </div>
                    <button class="btn btn-primary" name="edit_profile">Save Changes</button>
                  </form>
                </div>
              </div>
            </div>
            <?php
                if(isset($_POST['edit_profile'])){
                    $fname = $_POST["firstname"];
                    $lname = $_POST["lastname"];
                    $email = $_POST["Email"];
                    $birth_date = $_POST["birth"];
                    $gender = $_POST["optradio"];
                    $city = $_POST["city"];
                    $country = $_POST["country"];
                    $array = array($city, $country);
                    $location = implode(",",$array);
                    $about = $_POST["information"];
                    $sql="update users set first_name='".$fname."',last_name='".$lname."',about='".$about."',birth_date='".$birth_date."',email='".$email."',location='".$location."' where user_id=".$_SESSION['userid'];
                    $result = $mysqli->query($sql);
                }
            ?>
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
