<!DOCTYPE html>
<html lang="en">
	<head>
    <meta http-equiv="content-type" content="text/php; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="" />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
		<meta name="robots" content="index, follow" />
		<title>Event Details</title>


	</head>
  <body>
    <?php include 'header.php'?>
    <!--======================Page Container START===================================-->

    <div id="page-contents">
    	<div class="container">
    		<div class="row">

    			<!-- Newsfeed Common Side Bar Left
          ================================================= -->
    			<div class="col-md-3 static">
           		<h4 style="margin-bottom: 30px;">Event organised by:</h4>
            <div class="profile-card">
            	
            	<img src="images/users/user-8.jpg" alt="user" class="profile-photo" />
            	<h5><a href="profile.html" class="text-white">Richard Bell</a></h5>
            	<a href="newsfeed-people-nearby.html#" class="text-white"><i class="ion ion-android-person-add"></i> 1,299 followers</a>
            </div><!--profile card ends-->

          </div>
    	  <div class="col-md-7">

            <div class="details">
            	<div class="img-wrapper">
				  <img src="images/post-images/6.jpg" alt="" class="img-responsive post-image" />
				</div>
            	<h3>Singing at Chinagarden</h3>
				<p><strong>Monday, 22.08.2017 - Starting from: 17.00</strong></p>
           		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            </div>

            <!-- Nearby People List
            ================================================= -->
            <div class="people-nearby">
              <div class="google-maps">
                <div id="map" class="map"></div>
				</div>
            </div>
            
            
            <!-- Post Create Box
            ================================================= -->
            <div class="create-post">
            	<div class="row">
            		<div class="col-md-10 col-sm-10">
                  <div class="form-group">
                    <img src="images/users/user-1.jpg" alt="" class="profile-photo-md" />
                    <textarea name="texts" id="exampleTextarea" cols="50" rows="1" class="form-control" placeholder="Write what you wish"></textarea>
                  </div>
                </div>
            		<div class="col-md-2 col-sm-2">
                  <div class="tools">
                    <button class="btn btn-primary pull-right">Publish</button>
                  </div>
                </div>
            	</div>
            </div><!-- Post Create Box End -->
            
          </div>
          
          

          <!-- Newsfeed Common Side Bar Right
          ================================================= -->
    			<div class="col-md-2 static">
            <div class="suggestions" id="sticky-sidebar">
              <h4 class="grey">Who will go</h4>
              <div class="follow-user">
                <img src="images/users/user-11.jpg" alt="" class="profile-photo-sm pull-left" />
                <div>
                  <h5><a href="profile.html">Diana Amber</a></h5>
                  <a href="newsfeed-people-nearby.html#" class="text-green">Add friend</a>
                </div>
              </div>
              <div class="follow-user">
                <img src="images/users/user-12.jpg" alt="" class="profile-photo-sm pull-left" />
                <div>
                  <h5><a href="profile.html">Cris Haris</a></h5>
                  <a href="newsfeed-people-nearby.html#" class="text-green">Add friend</a>
                </div>
              </div>
              <div class="follow-user">
                <img src="images/users/user-13.jpg" alt="" class="profile-photo-sm pull-left" />
                <div>
                  <h5><a href="profile.html">Brian Walton</a></h5>
                  <a href="newsfeed-people-nearby.html#" class="text-green">Add friend</a>
                </div>
              </div>
              <div class="follow-user">
                <img src="images/users/user-14.jpg" alt="" class="profile-photo-sm pull-left" />
                <div>
                  <h5><a href="profile.html">Olivia Steward</a></h5>
                  <a href="newsfeed-people-nearby.html#" class="text-green">Add friend</a>
                </div>
              </div>
              <div class="follow-user">
                <img src="images/users/user-15.jpg" alt="" class="profile-photo-sm pull-left" />
                <div>
                  <h5><a href="profile.html">Sophia Page</a></h5>
                  <a href="newsfeed-people-nearby.html#" class="text-green">Add friend</a>
                </div>
              </div>
            </div>
          </div>
    		</div>
    	</div>
    </div>


    <!--======================Page Container STOP====================================-->
    <?php include 'footer.php' ?>
  </body>
</html>
