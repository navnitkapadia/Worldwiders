<!DOCTYPE html>
<html lang="en">
	<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="" />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
		<meta name="robots" content="index, follow" />
		<title>Home logged - messages</title>

    <!-- Stylesheets
    ================================================= -->
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/ionicons.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link href="css/emoji.css" rel="stylesheet">
    
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
    
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="images/fav.png"/>
    <style>
    .hide{
      display:none;
    }
    </style>
	</head>
  <body>
    <?php include 'header.php' ?>
    <div id="page-contents">
    	<div class="container">
    		<div class="row">

    			<!-- Newsfeed Common Side Bar Left
          ================================================= -->
    			<div class="col-md-3 static">
            <div class="profile-card">
            	<img src="images/users/user-1.jpg" alt="user" class="profile-photo" />
            	<h5><a href="timeline.html" class="text-white">Sarah Cruiz</a></h5>
            	<a href="newsfeed-messages.html#" class="text-white"><i class="ion ion-android-person-add"></i> 1,299 followers</a>
            </div><!--profile card ends-->
            <ul class="nav-news-feed">
              <li><i class="icon ion-ios-paper"></i><div><a href="home-logged.html">My Newsfeed</a></div></li>
              <li><i class="icon ion-ios-people"></i><div><a href="groups.html">Groups</a></div></li>
              <li><i class="icon ion-android-bar"></i><div><a href="events.html">Events</a></div></li>
              <li><i class="icon ion-ios-people-outline"></i><div><a href="friends.html">Friends</a></div></li>
              <li><i class="icon ion-chatboxes"></i><div><a href="messages.html">Messages</a></div></li>
            </ul><!--news-feed links ends-->
            <div id="chat-block">
              <div class="title">Chat online</div>
              <ul class="online-users list-inline">
                <li><a href="newsfeed-messages.html" title="Linda Lohan"><img src="images/users/user-2.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li><a href="newsfeed-messages.html" title="Sophia Lee"><img src="images/users/user-3.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li><a href="newsfeed-messages.html" title="John Doe"><img src="images/users/user-4.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li><a href="newsfeed-messages.html" title="Alexis Clark"><img src="images/users/user-5.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li><a href="newsfeed-messages.html" title="James Carter"><img src="images/users/user-6.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li><a href="newsfeed-messages.html" title="Robert Cook"><img src="images/users/user-7.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li><a href="newsfeed-messages.html" title="Richard Bell"><img src="images/users/user-8.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li><a href="newsfeed-messages.html" title="Anna Young"><img src="images/users/user-9.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li><a href="newsfeed-messages.html" title="Julia Cox"><img src="images/users/user-10.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
              </ul>
            </div><!--chat block ends-->
          </div>
    			<div class="col-md-9">

            <!-- Chat Room
            ================================================= -->
            <div class="chat-room">
              <div  class="row">
                <div class="col-md-5">
                  <ul class="nav nav-tabs contact-list scrollbar-wrapper scrollbar-outer">
                  <?php
      $user = $_SESSION['userid'];
      require 'api/db_config.php';
      $sql = "SELECT U.user_id,C.c_id as conversation_id,R.reply,C.time,U.fb_id,U.first_name,U.last_name
FROM users U,conversation C, conversation_reply R
WHERE 
CASE

WHEN C.user_one = '$user'
THEN C.user_two = U.user_id
WHEN C.user_two = '$user'
THEN C.user_one= U.user_id
END

AND 
C.time=R.time
AND
(C.user_one ='$user' OR C.user_two ='$user') ORDER BY C.c_id DESC";


                 
      $result = $mysqli->query($sql);
      $count = 0;
      if(mysqli_num_rows($result) == 0 ){
       echo '<li>No Conversation</li>';
      }else{
        while($row = $result->fetch_assoc())
        {
          
          extract($row);

              $count++;
          ?>
                  <!-- Contact List in Left-->
                    <li class="<?php if($count==1){echo 'active'; } ?>">
                      <a id="open-conversation" href="#<?php echo $first_name; ?>" con-id="<?php echo $conversation_id; ?>" data-toggle="tab">
                        <div class="contact">
                        	<img src=<?php echo  "http://graph.facebook.com/$fb_id/picture?type=large"; ?> alt="" class="profile-photo-sm pull-left"/>
                        	<div class="msg-preview">
                        		<h6><?php  echo $first_name .' '. $last_name; ?></h6>
                        		<p class="text-muted"><?php echo $reply; ?></p>
                            <small class="text-muted"><?php echo time_elapsed_string("@$time"); ?></small>
                            <!-- <div class="chat-alert">1</div> -->
                        	</div>
                        </div>
                      </a>
                    </li>
     <?php }
      }?>
                  </ul><!--Contact List in Left End-->

                </div>
                <div class="col-md-7">
                  <!--Chat Messages in Right-->
                  <div class="tab-content">
                  <?php
                  $chat = $mysqli->query($sql);
                  $count = 0;
                  while($row1 = $chat->fetch_assoc()){
                    extract($row1);
                    $count++;
                   ?>
                    <div class="tab-pane <?php if($count==1){echo 'active'; }  ?> " id="<?php echo $first_name; ?>">
                      <div class="chat-body">
                      	<ul  id="conversation"  class="chat-message <?php echo "open-$conversation_id"; ?>">
                        <input type="hidden" id="conversation_id" value="<?php echo $conversation_id; ?>">
                          
                      	</ul>

                      </div>
					     <div class="send-message">
                      <script>
                     
                          </script>
                    <div class="input-group">
                      <input type="text" class="form-control" id ="<?php echo "open-btn-$conversation_id"; ?>" placeholder="Type your message">
                      <span class="input-group-btn">
                        <button class="btn btn-default" onClick="getMessages(this.id,<?php echo $conversation_id; ?>,<?php echo $_SESSION['userid']; ?>,<?php echo $user_id; ?>)" id ="<?php echo "open-btn-$conversation_id"; ?>" type="button">Send</button> <span id="error"></span>
                      </span>
                    </div>
                  </div>           
                    </div>
                  <?php } ?>
                  </div><!--Chat Messages in Right End-->
					  
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
    		</div>
    	</div>
    </div>

  <?php include 'footer.php' ?>
<script src="js/messages.js"></script> 
  </body>
</html>
