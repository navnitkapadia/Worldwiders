<!DOCTYPE php>
<php lang="en">
	<head>
    <meta http-equiv="content-type" content="text/php; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="" />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
		<meta name="robots" content="index, follow" />
		<title>My Friends</title>


	</head>
  <body>
    <?php include 'header.php'?>
    <!--======================Page Container START===================================-->


    <div class="container">
    <?php
      $user = $_SESSION['userid'];
      $sql = "SELECT * FROM users where user_id = $user";
      $result = $mysqli->query($sql);
      while($row = $result->fetch_assoc())
      {
        extract($row);
        $pa = $cover.'&oe='.$oe;
        $list = explode(",", $friends_ids);
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
                    <img src=<?php echo  "http://graph.facebook.com/$fb_id/picture?type=large"; ?> alt="" class="img-responsive profile-photo" />
                    <h3><?php echo $name; ?></h3>
                    <!-- <p class="text-muted">Creative Director</p> -->
                  </div>
                </div>
                <div class="col-md-9">
                  <ul class="list-inline profile-menu">
                    <li><a href="profile.php" >About</a></li>
                    <li><a href="friends.php" class="active">Friends</a></li>
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
                <li><a href="timline.php">Timeline</a></li>
                <li><a href="timeline-about.php">About</a></li>
                <li><a href="timeline-album.php">Album</a></li>
                <li><a href="timeline-friends.php" class="active">Friends</a></li>
              </ul>
              <button class="btn-primary">Add Friend</button>
            </div>
          </div><!--Timeline Menu for Small Screens End-->

        </div>
        <div id="page-contents">
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-9">

              <!-- Friend List
              ================================================= -->
              <div class="friend-list">
                <div class="row">
                  <?php
                      if(sizeof($list) > 1){
                        for($i=0; $i<sizeof($list); $i++){
                          $flist = "SELECT * FROM users where user_id = $list[$i]";
                          $resultlist = $mysqli->query($flist);
                          while($row = $resultlist->fetch_assoc()){
                            extract($row);
                          ?>
                            <div class="col-md-4 col-sm-4">
                              <div class="friend-card">
                                <img style="height: 101px; width: 242px;" src=<?php if($cover){ echo $cover.'&oe='.$oe; } else { echo "images/covers/1.jpg"; } ?> alt="profile-cover" class="img-responsive cover" />
                                <div class="card-info">
                                  <img src=<?php echo  "http://graph.facebook.com/$fb_id/picture?type=large"; ?> alt="user" class="profile-photo-lg" />
                                  <div class="friend-info">
                                    <a href="messages.php?friendid=<?php echo $user_id;?>" class="pull-right text-green">Message</a>
                                    <h5><a href="timeline.php" class="profile-link"><?php echo $first_name . $last_name; ?></a></h5>
                                    <p>Student at Harvard</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php }
                        }
                      }else {
                        echo "Nothing Found";
                      }
                  ?>
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
