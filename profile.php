
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
		<div class="container profile">
		<?php
		  $add = "";
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
			    
    	<div class="cover"  <?php if($cover !=""){ echo "style='background-image: url($pa)';";} ?>></div>
    
		<div class="row">
        	<div class="col-lg-3 col-md-3 col-sm-4">
			  <?php include 'homemenu.php' ?>
     		</div>
			 
     		<div class="col-lg-7 col-md-7 col-sm-5" id="page-content">
				  <div class="bs-docs-section clearfix">
				  	<div class="row your-header">
				  		<div class="col-sm-3">
				  			<img src=<?php echo  "http://graph.facebook.com/$fb_id/picture?type=large"; ?> alt="" class="img-fluid profile-photo">
						</div>
						<div class="col-sm-6">
							<h1><?php echo $name; ?></h1>
							<h2><?php echo $position; ?></h2>
							<?php
								if(!isset($see)){
									echo "<p><a href='#'><i class='fa fa-wrench icon' aria-hidden='true'></i> Edit informations</a></p>";
								}
							?>
							
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
                     }
						?>
						
							
							
						</div>
					</div>
					<div class="row infos">
					  <div class="col-lg-9">
						<h2><i class="fa fa-user-circle-o icon" aria-hidden="true"></i> Personal Information</h2>
						<p><?php echo $about; ?></p>
						<h2><i class="fa fa-star-o icon" aria-hidden="true"></i> Groups</h2>
						<div class="row group-list">
						
						<?php
							$join = true;
							$user = $_SESSION['userid'];
							$sql = "SELECT pg.* from peoples_group pg,group_member gm where pg.id=gm.group_id and gm.user_id=$user";
							$result = $mysqli->query($sql);
							while ($row = $result->fetch_assoc()) {
									extract($row);
              ?>
              	<div class="col-sm-4 group-box">
							  	<div class="col-sm-12 img-wrapper" style="background-image: url('<?php if ($file) {
                                        echo "upload/$file";
                                    } else {
                                        echo 'images/covers/5.jpg';
                                    } ?>')">
							  	</div>
							  	<div class="col-sm-12 group-info">
										<h4><a href="group-details.php?id=<?php echo $id; ?>"><?php echo $title; ?></a></h4>
										<p><i class="fa fa-people" aria-hidden="true"></i> 
										
										<?php
											$sql1 = "SELECT COUNT(*) as co FROM group_member WHERE group_id=$id";
											$result1 = $mysqli->query($sql1);
											while ($row1 = $result1->fetch_assoc()) {
												extract($row1);
												echo "$co";
											}
										?> group members</p>
							  	</div>
								</div>                      
							<?php } ?>
						
							
							
						</div>
					  </div>
					  <div class="col-lg-3">
					  	<h2><i class="fa fa-heart-o icon" aria-hidden="true"></i> Interest</h2>
						<ul id="interests" class="interests list-inline">
						</ul>
						
						<h2><i class="fa fa-flag icon" aria-hidden="true"></i> Languages</h2>
						 <ul id="lang">
						  </ul>
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
    		<div class="col-lg-2 col-md-2 col-sm-3">
    			<div id="right-content" class="right-content">
					<div class="row">
						<div class="col-sm-12">
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
                      
					  <p><?php echo $dost; ?> people are connected </p>
                     <?php } ?>
						
							
							<?php
                            $inlist = array();
                            $list = "SELECT friend_id as fb FROM friend_list where user_id = '" . $_SESSION['userid'] . "'";
                            $resultlist2 = $mysqli->query($list);
                            while ($row2 = $resultlist2->fetch_assoc()) {
                                extract($row2);
                                $inlist[] = $fb;
                            }
                            $userlis = "SELECT * FROM users where user_id != '" . $_SESSION['userid'] . "'";
                            $resultlist1 = $mysqli->query($userlis);
                            if (mysqli_num_rows($resultlist1) > 1) {
                                while ($row = $resultlist1->fetch_assoc()) {
                                    extract($row);
                                    if (!in_array($user_id, $inlist)) {
                                        ?>
                            
							<div class="people-item">
								<div class="col-sm-3 image"><img src="<?php echo "http://graph.facebook.com/$fb_id/picture"; ?>" class="img-responsive img-circle" /></div>
								<div class="col-sm-9">
									<p class="user"><a href="profile.php?id=<?php echo $user_id; ?>"><?php echo $name; ?></a></p>
                                    <a href="api/insert.php?action=addfriend&friendid=<?php echo $user_id; ?>" class="btn btn-info">Add friend</a>
								</div>
							</div>


                            <?php
                                    }
                                }
                            }
                            ?>
							<div class="col-sm-12 text-center see-more">
								<a href="friend.php" class="btn btn-info">See more</a>
							</div>
							
							
						</div>
					</div>
   					<div class="row">
   						<div class="col-sm-12">
   							<div class="banner-example">A banner here</div>
   						</div>
   					</div>
    			</div>
			</div>
		</div>
		<?php } ?>
	</div>
		<!--======================Page Container STOP====================================-->
		<?php include 'footer.php' ?>

		<script>
		function initMap() {
		  console.log('iinit');
	  var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 15,
	  });
	  var geocoder = new google.maps.Geocoder();
		geocodeAddress(geocoder, map);
	}

	function geocodeAddress(geocoder, resultsMap) {
	  console.log('GoogleAddress');
	  var address = "<?php echo $add ?>";
	  geocoder.geocode({'address': address}, function(results, status) {
		if (status === 'OK') {
		  resultsMap.setCenter(results[0].geometry.location);
		  var marker = new google.maps.Marker({
			map: resultsMap,
			position: results[0].geometry.location
		  });
		} else {
		  alert('Geocode was not successful for the following reason: ' + status);
		}
	  });
	}
	</script>

		<script async defer
	  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTMXfmDn0VlqWIyoOxK8997L-amWbUPiQ&callback=initMap">
	  </script>
	<script> 
		<?php if(isset($_REQUEST['id'])){
			$see = $_REQUEST['id'];
			echo "$('#lang').load('api/getdata.php?action=lang&userid=$see');";
			echo "$('#interests').load('api/getdata.php?action=intrest&userid=$see');";
		  }else {
			echo "$('#lang').load('api/getdata.php?action=lang');";
			echo "$('#interests').load('api/getdata.php?action=intrest');";
		  } 
		?>
	</script>
	  </body>
	</php>
