
<!DOCTYPE html>
<html lang="en">
	<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="" />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
		<meta name="robots" content="index, follow" />
		<title>My Friends</title>


	</head>
  <body>
    <?php include 'header.php'?>
    <?php 
	if(!isset($_SESSION['fbid']) && !isset($_SESSION['userid'])){
		 header('Location: /');
	}
?>
    <!--======================Page Container START===================================-->


    <div class="container">
    <?php
      $user = $_SESSION['userid']; 
      if(isset($_REQUEST['id'])){
        $see = $_REQUEST['id'];
        $sql = "SELECT * FROM users where user_id = $see";
      }else {
        $sql = "SELECT * FROM users where user_id = $user";
      }
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
                    <img src=<?php echo  "http://graph.facebook.com/$fb_id/picture?type=large"; ?> alt="" class="img-responsive profile-photo" />
                    <h3><?php echo $name; ?></h3>
                    <!-- <p class="text-muted">Creative Director</p> -->
                  </div>
                </div>
                <div class="col-md-9">
                  <ul class="list-inline profile-menu">
                  <?php 
                  if(isset($_REQUEST['id'])){
                    echo "<li><a href='profile.php?id=$see'>About</a></li>";
                    echo "<li><a href='friends.php?id=$see'>Friends</a></li>";
                  } else {
                    echo "<li><a href='profile.php'>About</a></li>";
                    echo "<li><a href='friends.php'>Friends</a></li>";
                  }
                  ?>
                  </ul>
                  <ul class="follow-me list-inline">
                     <?php 
                     if(isset($see)){
                       $sql = "SELECT count(*) as dost FROM friend_list where user_id = $see";
                     } else {
                      $sql = "SELECT count(*) as dost FROM friend_list where user_id = $user";
                     }
                        $result = $mysqli->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            extract($row);
                     ?> 
                      <li><?php echo $dost; ?>&nbsp; people following</li>
                     <?php } ?>
                     <?php
                     if(isset($see)){ 
                      $sql1 = "SELECT COUNT(*) as cn FROM friend_list WHERE user_id= $user and friend_id=$see";
                      $result1 = $mysqli->query($sql1);
                      while ($row = $result1->fetch_assoc()) {
                          extract($row);
                          if($cn==1){
                            echo "<li><a href='messages.php?id=<?php echo base64_encode($see);?>'><button class='btn-primary'>Message</button></a></li>";
                          } else {
                            echo "<li><a href='api/insert.php?action=addfriend&friendid=$user_id'><button class='btn-primary'>Add friend</button></a></li>";
                          }
                      }
                     } else {
                       echo "<li><a href='edit-profile.php'><button class='btn-primary'>Edit friend</button></a></li>";
                     }      
                    ?>
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
                          $flist = "SELECT f.*, u.fb_id,u.name,u.cover as ucover,u.oe as uoe FROM friend_list f, users u where f.friend_id=u.user_id and f.user_id = $user_id";
                          $resultlist = $mysqli->query($flist);
                          if(mysqli_num_rows($resultlist) > 0 ){  
                            while($row = $resultlist->fetch_assoc()){
                            extract($row);
                          ?>
                            <div class="col-md-4 col-sm-4">
                              <div class="friend-card">
                                <img style="height: 101px; width: 242px;" src=<?php if($ucover){ echo $ucover.'&oe='.$uoe; } else { echo "images/covers/1.jpg"; } ?> alt="profile-cover" class="img-responsive cover" />
                                <div class="card-info">
                                  <img src=<?php echo  "http://graph.facebook.com/$fb_id/picture?type=large"; ?> alt="user" class="profile-photo-lg" />
                                  <div class="friend-info">
                                    <a href="messages.php?id=<?php echo base64_encode($friend_id);?>" class="pull-right text-green">Message</a>
                                    <h5><a href="profile.php?id=<?php echo $friend_id;?>" class="profile-link"><?php echo $name; ?></a></h5>
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                          <?php } 
                         
                         } else ?>
                         </div>
                         <div class="row">
                         <h3>People may you know</h3>
                         <?php  {
                          $inlist = array();   
                          $list = "SELECT friend_id as fb FROM friend_list where user_id = $user_id";
                          $resultlist2 = $mysqli->query($list);
                          while($row2 = $resultlist2->fetch_assoc()){
                                extract($row2);
                                $inlist[] = $fb;
                          }
                          $userlis = "SELECT * FROM users where user_id != $user_id";
                          $resultlist1 = $mysqli->query($userlis);
                          if(mysqli_num_rows($resultlist1) > 1 ){
                            while($row = $resultlist1->fetch_assoc()){
                            extract($row);
                            if(!in_array($user_id, $inlist)){
                            ?>
                            <div class="col-md-4 col-sm-4">
                              <div class="friend-card">
                                <img style="height: 101px; width: 242px;" src=<?php if($cover){ echo $cover.'&oe='.$oe; } else { echo "images/covers/1.jpg"; } ?> alt="profile-cover" class="img-responsive cover" />
                                <div class="card-info">
                                  <img src=<?php echo  "http://graph.facebook.com/$fb_id/picture?type=large"; ?> alt="user" class="profile-photo-lg" />
                                  <div class="friend-info">
                                      <?php 
                                        if($user_id != $user){ ?>
                                          <a href="api/insert.php?action=addfriend&friendid=<?php echo $user_id;?>" class="pull-right text-green">Add friend</a>
                                        <?php }
                                       ?>
                                    <h5><a href="profile.php?id=<?php echo $user_id;?>" class="profile-link"><?php echo $first_name . $last_name; ?></a></h5>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <?php
                          }
                        }
                      }
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
</html>
