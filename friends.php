
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
    <?php
    include 'header.php';
    ?>
    <!--======================Page Container START===================================-->
    <div class="container profile">
	 <?php
      $user = $_SESSION['userid']; 
      if(isset($_REQUEST['id'])){
        $see = $_REQUEST['id'];
        $sql11 = "SELECT * FROM users where user_id = $see";
      }else {
        $sql11 = "SELECT * FROM users where user_id = $user";
      }
      $result11 = $mysqli->query($sql11);
      while($row11 = $result11->fetch_assoc())
      {
        extract($row11);
        $pa = $cover.'&oe='.$oe;
    ?>
    	<div class="cover"  <?php if($cover !=""){ echo "style='background-image: url($pa)';";} ?>></div>
    
		<div class="row">
		
        	<div class="col-lg-3 col-md-3 col-sm-4">
			  <?php include 'homemenu.php' ?>
     		</div>
     		<div class="col-lg-8 col-md-8 col-sm-5" id="page-content">
				  <div class="bs-docs-section clearfix">
				  	<div class="row your-header">
				  		<div class="col-sm-3">
						
				  			<img src=<?php echo  "http://graph.facebook.com/$fb_id/picture?type=large"; ?> alt="" class="img-fluid profile-photo">
						</div>
						<div class="col-sm-6">
							<h1><?php echo $name; ?></h1>
							<!--  <h2>UX Designer</h2> -->
						</div>
						<div class="col-sm-3">
						
                     <?php
                     if(isset($see)){ 
                      $sql1 = "SELECT COUNT(*) as cn FROM friend_list WHERE user_id= $user and friend_id=$see";
                      $result1 = $mysqli->query($sql1);
                      while ($row = $result1->fetch_assoc()) {
                          extract($row);
                          if($cn==1){
                            echo "<a href='messages.php?id=<?php echo base64_encode($see);?>'><button class='btn btn-success'>Message</button></a>";
                          } else {
                            echo "<a href='api/insert.php?action=addfriend&friendid=$user_id'><button class='btn btn-success'>Add friend</button></a>";
                          }
                      }
                     } else {
                       echo "<a href='edit-profile.php'><button class='btn btn-success'>Edit Profile</button></a>";
                     }      
                    ?>
						</div>
					</div>
					<div class="row friends">
					    <h2>Connection</h2>
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
                      
					  <p><?php echo $dost; ?> people are connected with <?php echo $name; ?></p>
                     <?php } ?>
					<?php
					  $flist = "SELECT f.*, u.fb_id,u.name,u.cover as ucover,u.oe as uoe FROM friend_list f, users u where f.friend_id=u.user_id and f.user_id = $user_id";
					  $resultlist = $mysqli->query($flist);
					  if(mysqli_num_rows($resultlist) > 0 ){  
						while($row = $resultlist->fetch_assoc()){
						extract($row);
                          ?>
							<div class="col-sm-3 text-center">
								<img src=<?php echo  "http://graph.facebook.com/$fb_id/picture?type=small"; ?>	 class="img-circle" />
								<p class="user"><a href="profile.php?id=<?php echo $friend_id;?>"><?php echo $name; ?></a></p>
								<p><a href="messages.php?id=<?php echo base64_encode($friend_id);?>" class="btn btn-info">Message</a></p>
							</div>	
							
					  <?php } }?>
					</div>
	  			</div>
	  <?php } ?>
				  <?php include 'content-footer.php' ?>
    		</div>
    		<!-- 
			<div class="col-lg-2 col-md-2 col-sm-3">
    			<div id="right-content" class="right-content">
   					<div class="row">
   						<div class="col-sm-12">
   							<div class="banner-example">A banner here</div>
   						</div>
   					</div>
    			</div>
			</div>
 			-->
		</div>
	</div>

    <!--======================Page Container STOP====================================-->
    <?php include 'footer.php' ?>
  </body>
</html>
