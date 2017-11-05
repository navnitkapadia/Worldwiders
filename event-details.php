<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/php; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="" />
        <meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
        <meta name="robots" content="index, follow" />
        <title>Event Details</title>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>    
    <script type="text/javascript">
        $(function() {
            $("#comment").load("post.php?action=comment&id=<?php echo $_GET['id']; ?>");
            $('.post').click(function(){
               var ids = this.id;
               var comment = $('.texts').val();
               $('.post').hide();
               $.ajax({
                type: 'post',
                url: "post.php?action=event-post",
                data: "id=" + ids + "&texts=" + comment,
                    success: function(data){
                    //clear the message box
                      $('.texts').val("");
                      $('#comment').load("post.php?action=comment&id="+ids);
                      $('.post').show();
                    }
                });
            });
        });
    </script>

    </head>
    <body>
        <?php include 'header.php' ?>    
        <!--======================Page Container START===================================-->
			    <div class="container">
		<div class="row">
        	<div class="col-lg-3 col-md-3 col-sm-4">
			 <?php include 'homemenu.php' ?>
     		</div>
			 
                          <?php
						  $Login_Id = $_SESSION['userid'];
                            $login = $_SESSION['fbid'];
                            $event_Id = $_GET['id'];
                        $sql = "SELECT e.* FROM event e where e.id='" . $event_Id . "'";
						
                        $result = $mysqli->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            extract($row);
                            ?>
                      
							
     		<div class="col-lg-7 col-md-7 col-sm-5" id="page-content">
				  <div class="bs-docs-section clearfix no-margin">
					<div class="row">
					  <div class="col-lg-12 event-detail">
					  	<div class="row signup">
					  		<div class="col-lg-8 decision">
							I will: 
							<?php
                            $flage = 0;
                            $sql = "SELECT e.created_by as user FROM event e where e.id='" . $event_Id . "'";
                            $result = $mysqli->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                extract($row);
                                if ($user == $_SESSION['userid']) {
                                    $flage = 2;
                                }
                            }
                            ?>
							<?php
                            $sql = "SELECT e.start_date as edate,e.user_id as user FROM event e where e.id='" . $event_Id . "'";
                            $result = $mysqli->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                extract($row);
                                $add = explode(",", $user);
                                if (in_array($_SESSION['userid'], $add)) {
                                    
                                } elseif ($flage == 2) {
                                     
                                } else {
                                    $current = new DateTime();
                                    $now = $current->format('Y-m-d');
                                    if($now < $edate) {
                                        echo '<a href="update.php?id=' . $event_Id . '"><button type="button" class="btn btn-success">GO</button></a>';
                                    } else {
                                        
                                    }
                                }
							}
                                ?>
							
							<!-- <a href="#" class="btn btn-success">Go</a> <a href="#" class="btn btn-danger">Can't go</a> -->
							</div>
							<!--
							<div class="col-lg-4">
								<a href="#" class="btn btn-info">I'm interested</a>
							</div>
							-->
					  	</div>
						<h1><?php echo $event; ?></h1>
						<div class="col-sm-12">
					  	  <div class="cover-image" style="background-image: url('upload/<?php echo $file; ?>')"></div>
						  <div class="row details">
						  		<div class="col-sm-6">
						  			<div class="col-sm-3"><i class="fa fa-clock-o fa-2x" aria-hidden="true"></i></div>
									<div class="col-sm-9 txt"><?php echo date('d.m.Y , l', strtotime($start_date)); ?>-<?php echo $start_time; ?></div>
						  		</div>
						  		<div class="col-sm-6">
						  			<div class="col-sm-3"><i class="fa fa-map-o fa-2x" aria-hidden="true"></i></div>
									<div class="col-sm-9 txt"><a href="#"><?php echo $location_address; ?></a></div>
						  		</div>
						  		<div class="col-sm-6 margin-10">
						  			<div class="col-sm-3"><i class="fa fa-ticket fa-2x" aria-hidden="true"></i></div>
									<div class="col-sm-9 txt">25.00 CHF Entrance fee</div>
						  		</div>
						  		<div class="col-sm-6 margin-10">
						  			<div class="col-sm-3"><i class="fa fa-group fa-2x" aria-hidden="true"></i></div>
									<div class="col-sm-9 txt">Guests: <?php $add = explode(",", $user_id);
										echo count($add); ?> / <?php echo $max_limit; ?></div>
						  		</div>
						  </div>
						  <p><?php echo $description; ?></p>
						  
						  <div class="row guests">
						  	<h3>Attendees</h3>
						  	<ul>
							<?php 
							
							$add = explode(",", $user_id);
							
                                    for ($i = 0; $i < count($add); $i++) {
                                        $sql = "SELECT u.user_id,u.name,u.fb_id FROM users u where u.user_id='" . $add[$i] . "'";
                                        $result = $mysqli->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                            extract($row);
                                                       echo "<li class='user-round' title='$name' >
									<a href='profile.php?id=$user_id'>
										<img src='http://graph.facebook.com/$fb_id/picture?type=small'/>
									</a>
								</li>";
                                                    }
                                                   
										}
									
							    ?>
						  		
						  	
							
							
							</ul>
						  </div>
						  
						</div>
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
			
			<?php } ?>  
			
			
    		<div class="col-lg-2 col-md-2 col-sm-3">
    			<div id="right-content" class="right-content">
					<div class="row">
						<div class="col-sm-12 organised">
							<h3>Organised by</h3>
							<?php
                            $addofmap  = "";
                            $Login_Id = $_SESSION['userid'];
                            $login = $_SESSION['fbid'];
                            $event_Id = $_GET['id'];
                            $sql = "SELECT u.user_id, e.location_address,e.created_by,u.name,u.fb_id FROM event e,users u where e.id='" . $event_Id . "' and e.created_by=u.user_id";
                            $result = $mysqli->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                extract($row);
                                $addofmap = $location_address;
                                ?>
							<div class="people-item">
								<div class="col-sm-3 image"><img src="<?php echo "http://graph.facebook.com/$fb_id/picture?type=small"; ?>" class="img-responsive img-circle" /></div>
								<div class="col-sm-9">
									<p class="user"><a href="#"><?php echo $name; ?></a></p>
									<?php
                            $inlist = array();
							$sessinUser = $_SESSION['userid'];
                            $list = "SELECT friend_id as fb FROM friend_list where user_id = $user_id";
                            $resultlist2 = $mysqli->query($list);
                            while ($row2 = $resultlist2->fetch_assoc()) {
                                extract($row2);
                                $inlist[] = $fb;
                            }
								if($sessinUser !== $user_id){
								if (!in_array($sessinUser, $inlist)) {
                                        ?>
									<p><a href="profile.php?id=<?php echo $user_id;?>" class='btn btn-info'>Add friend</a></p>
									
									
									<?php
                                    }else { ?> 
									<p><a href="messages.php?id=<?php echo base64_encode($user_id);?>" class='btn btn-info'>Message</a></p>
									
								  <?php }
								  
								} else { ?>
								<a class='btn btn-info'>It's me</a>
								<?php }
								
								
							
                                    
                           
                            ?>
								</div>
							</div>
							
                            <?php } ?>
							<div class="mini-calendar">
								<!-- <h3>Events calendar</h3>
								<div class="calendar">
									<div id="datepicker"></div>
								</div> -->
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
	</div>
        <!--======================Page Container STOP====================================-->
        <?php include 'footer.php' ?>
        <script>
    function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 15,
  });
  var geocoder = new google.maps.Geocoder();
    geocodeAddress(geocoder, map);
}

function geocodeAddress(geocoder, resultsMap) {
  var address = "<?php echo $addofmap; ?>";
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
    </body>
</html>
