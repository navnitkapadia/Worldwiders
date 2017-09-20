
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
				<script>
				window.document.title = "<?php echo $name; ?>"
				</script>
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
						<p class="text-muted"><?php echo $position; ?></p> 
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
						<li><?php echo $dost; ?> people following </li>
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

				<!-- Timeline Menu for Small Screens-->
				<div class="navbar-mobile hidden-lg hidden-md">
				  <div class="profile-info">
					
					<img src="" alt="" class="img-responsive profile-photo" />
					<h4><?php echo $name; ?></h4>
					<p class="text-muted"><?php echo $position; ?></p>
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
					  <div class="about-content-block">
						<h4 class="grey"><i class="ion-ios-location-outline icon-in-title"></i>Location</h4>
						<p><?php echo $location; 
						$add = $location;
						?></p>
						<div class="google-maps">
						  <div id="map" class="map"></div>
						</div>
					  </div>
					</div>
				  </div>
				  <div class="col-md-2 static about-profile">
					<div id="sticky-sidebar">
					  <div class="about-content-block">
						<h4 class="grey"><i class="ion-ios-heart-outline icon-in-title"></i>Interests</h4>
						<ul id="interests" class="interests list-inline">
						</ul>
					  </div>
					  <div class="about-content-block">
						<h4 class="grey"><i class="ion-ios-chatbubble-outline icon-in-title"></i>Language</h4>
						  <ul id="lang">
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
