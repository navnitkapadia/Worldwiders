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
 
    <div class="container">    
		<div class="row">
        	<div class="col-lg-3 col-md-3 col-sm-4">
			 <?php include 'homemenu.php' ?>
     		</div>
     		<div class="col-lg-9 col-md-9 col-sm-7" id="page-content">
				  <div class="bs-docs-section clearfix">
				  	<div class="row chat-room">
				  		<div class="col-md-12">
				  			<h1>Messenger</h1>
						</div>
				  		
			  		
			  		<div class="col-md-5">
                  <ul  class="nav nav-tabs contact-list chat-message" style="overflow-x: hidden;">
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
                $row = $resultcon->fetch_assoc();
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
                } else {
                  $necid = $row['c_id'];
                  $time=time();
                  $sql11 = "UPDATE conversation SET time=$time WHERE c_id =$necid";
                  $result11 = $mysqli->query($sql11);
                  $sql11 = "UPDATE conversation_reply SET time=$time WHERE reply='No messages clean11' and c_id_fk=$necid";
                  $result11 = $mysqli->query($sql11);
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
                            <p class="text-muted"><?php 
                            if($reply === 'No messages clean11'){
                                echo 'No new Message';
                            } else {
                                echo $reply;
                            }
                             ?></p>
                            <small class="text-muted"><?php echo time_elapsed_string("@$time"); ?></small>
                            <!-- <div class="chat-alert">1</div> -->
                        	</div>
                        </div>
                      </a>
                    </li>
     <?php }
      }?>
                  <li><input type="input" id="startconversation" class="new-convr form-control input-group-lg" title="Enter Name" placeholder="Enter Name"></li>
                  </ul><!--Contact List in Left End-->
                  <ul  class="search-box" id="list"></ul>
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
                      	<ul  id="conversation"  style="width:440px;overflow-x: hidden;" class="chat-message <?php echo "open-$conversation_id"; ?>">
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
                        <button class="<?php echo "open-btn-$conversation_id"; ?> btn btn-default" onClick="getMessages(this.id,<?php echo $conversation_id; ?>,<?php echo $_SESSION['userid']; ?>,<?php echo $user_id; ?>)" id ="<?php echo "open-btn-$conversation_id"; ?>" type="button">Send</button> <span id="error"></span>
                      </span>
                    </div>
                  </div>           
                    </div>
                  <?php } ?>
                  </div><!--Chat Messages in Right End-->
					  
                </div>
				  		
				  		
				  		
				  		
				  	</div>
				</div>

				  <footer>
					<div class="row">
					  <div class="col-lg-12">

						<ul class="list-unstyled">
						  <li class="pull-right"><a href="#top">Back to top</a></li>
						  <li><a href="#">About</a></li>
						  <li><a href="#">Advertise</a></li>
						  <li><a href="#">Privacy Policy / Terms</a></li>
						  <li><a href="#">Support / Contact</a></li>
						</ul>
						<p>Based on <a href="http://getbootstrap.com" rel="nofollow">Bootstrap</a>. Icons from <a href="http://fortawesome.github.io/Font-Awesome/" rel="nofollow">Font Awesome</a>. Web fonts from <a href="http://www.google.com/webfonts" rel="nofollow">Google</a>.</p>

					  </div>
					</div>

				</footer>
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

$("#startconversation").keyup(function() {
      var inputval = $( "#startconversation" ).val();
      $.ajax({
            type: "POST",
            url: "api/startConversation.php?q="+inputval,
            success: function(data){
                 $("#list").html(data);
            }
      });
    });


  $("#online-users-is").load("api/getonlineUsers.php");
  window.setInterval(function(){
    $("#online-users-is").load("api/getonlineUsers.php");
   },20000);
</script>
  </body>
</html>
