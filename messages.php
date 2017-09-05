<?php 
	session_start();
	if(!isset($_SESSION['fbid']) && !isset($_SESSION['userid'])){
		 header('Location: /');
	}
?>
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
            <?php include 'homemenu.php' ?>
            <div id="chat-block">
              <div class="title">Chat online</div>
              <ul id="online-users-is" class="online-users list-inline">
                
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
               if(isset($_REQUEST['id'])){
                $user =  $_SESSION['userid'];
                 $encoded = trim(mysqli_real_escape_string($mysqli,$_REQUEST['id']));
                 $want = base64_decode($encoded);
                $time=time();
                $ip=$_SERVER['REMOTE_ADDR'];
                $sqlcon="SELECT * FROM `conversation` WHERE 
                (user_one='$user' AND user_two='$want') OR (user_one='$want' AND user_two='$user')";
                $resultcon = $mysqli->query($sqlcon);
                if(mysqli_num_rows($resultcon) == 0 && $user != $want ){
                  $addcon = "INSERT INTO conversation (user_one, user_two, ip, time) VALUES 
                  ($user,$want,'$ip',$time)";
         $result1 = $mysqli->query($addcon);
           if($result1){
             $sqlcon="select max(c_id) as co from conversation";
             $resultcon = $mysqli->query($sqlcon);
               $row = $resultcon->fetch_assoc();
               extract($row);
               $conrep = "INSERT INTO conversation_reply(reply,user_id_fk,ip,time,c_id_fk) 
                           VALUES ('No messages clean11',$user,'$ip',$time,$co)";
                $result2 = $mysqli->query($conrep);
           }else {
             echo "Problem in insertion";
           }
                }
              }
  $user = $_SESSION['userid'];
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
          (C.user_one ='$user' OR C.user_two ='$user') ORDER BY C.time DESC";

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
                        		<p class="text-muted"><?php echo str_replace("clean11","",$reply); ?></p>
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
                      	<ul  id="conversation"  style="width:440px; overflow:scroll; overflow-x:hidden" class="chat-message <?php echo "open-$conversation_id"; ?>">
                        <input type="hidden" id="conversation_id" value="<?php echo $conversation_id; ?>">
                          
                      	</ul>

                      </div>
					     <div class="send-message">
                      <script>
                     
                          </script>
                    <div class="input-group">
                      <input type="text"  class="form-control" data-cid="<?php echo $conversation_id; ?>" 
                      data-sid="<?php echo $_SESSION['userid']; ?>" data-rid="<?php echo $user_id; ?>"
                       id="<?php echo "open-btn-$conversation_id"; ?>" placeholder="Type your message">
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
<script>
$(window).on('keypress', function (e) {
  if(e.which == 13) {
    var cid = e.target.getAttribute('data-cid');
    var sid = e.target.getAttribute('data-sid');
    var rid = e.target.getAttribute('data-rid')
    if(e.target.id && cid && sid && rid) {
      getMessages(e.target.id,cid,sid,rid);
    }
  }
});
  $("#online-users-is").load("api/getonlineUsers.php");
  window.setInterval(function(){
    $("#online-users-is").load("api/getonlineUsers.php");
   },20000);
</script>
  </body>
</html>
