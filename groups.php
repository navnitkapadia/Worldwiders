<!DOCTYPE php>
<php lang="en">
	<head>
    <meta http-equiv="content-type" content="text/php; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="" />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
		<meta name="robots" content="index, follow" />
		<title>Groups</title>


	</head>
  <body>
    <?php include 'header.php'?>
    <!--======================Page Container START===================================-->
     <div class="container">

      <!-- Timeline
      ================================================= -->
      <div class="timeline">
        <div id="page-contents">
          <div class="row">
			  <div class="col-md-12"><h2>Groups</h2></div>
            <div class="col-md-12">

              <!-- Friend List
              ================================================= -->
			  <?php
				mysql_connect("localhost","root","");
				mysql_select_db("demo");
				$query="select * from groups";
				$resultset=mysql_query($query);
				while($row=mysql_fetch_assoc($resultset))
				{
					extract($row);
			  ?>
			  
              <div class="friend-list">
                <div class="row">
                  <div class="col-md-4 col-sm-4">
                    <div class="friend-card">
                      <img src="upload/<?php echo $file; ?>" alt="profile-cover" class="img-responsive cover" />
                      <div class="card-info">
                        <div class="friend-info">
                          <a href="groups-detail.html" class="pull-right text-green">Already joined</a>
                          <h5><a href="groups-detail.html" class="profile-link"><?php echo $title; ?></a></h5>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--<div class="col-md-4 col-sm-4">
                    <div class="friend-card">
                      <img src="images/covers/3.jpg" alt="profile-cover" class="img-responsive cover" />
                      <div class="card-info">
                        <div class="friend-info">
                          <a href="groups-detail.html" class="pull-right text-red">Join</a>
                          <h5><a href="groups-detail.html" class="profile-link">Beer & wine lovers group</a></h5>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <div class="friend-card">
                      <img src="images/covers/5.jpg" alt="profile-cover" class="img-responsive cover" />
                      <div class="card-info">
                        <div class="friend-info">
                          <a href="groups-detail.html" class="pull-right text-red">Join</a>
                          <h5><a href="groups-detail.html" class="profile-link">Vegetarians and Vegans in Zurich</a></h5>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <div class="friend-card">
                      <img src="images/covers/1.jpg" alt="profile-cover" class="img-responsive cover" />
                      <div class="card-info">
                        <div class="friend-info">
                          <a href="groups-detail.html" class="pull-right text-green">Already joined</a>
                          <h5><a href="groups-detail.html" class="profile-link">English speaking Jobs group</a></h5>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <div class="friend-card">
                      <img src="images/covers/3.jpg" alt="profile-cover" class="img-responsive cover" />
                      <div class="card-info">
                        <div class="friend-info">
                          <a href="groups-detail.html" class="pull-right text-red">Join</a>
                          <h5><a href="groups-detail.html" class="profile-link">Beer & wine lovers group</a></h5>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <div class="friend-card">
                      <img src="images/covers/5.jpg" alt="profile-cover" class="img-responsive cover" />
                      <div class="card-info">
                        <div class="friend-info">
                          <a href="groups-detail.html" class="pull-right text-red">Join</a>
                          <h5><a href="groups-detail.html" class="profile-link">Vegetarians and Vegans in Zurich</a></h5>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <div class="friend-card">
                      <img src="images/covers/1.jpg" alt="profile-cover" class="img-responsive cover" />
                      <div class="card-info">
                        <div class="friend-info">
                          <a href="groups-detail.html" class="pull-right text-green">Already joined</a>
                          <h5><a href="groups-detail.html" class="profile-link">English speaking Jobs group</a></h5>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <div class="friend-card">
                      <img src="images/covers/3.jpg" alt="profile-cover" class="img-responsive cover" />
                      <div class="card-info">
                        <div class="friend-info">
                          <a href="groups-detail.html" class="pull-right text-red">Join</a>
                          <h5><a href="groups-detail.html" class="profile-link">Beer & wine lovers group</a></h5>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <div class="friend-card">
                      <img src="images/covers/5.jpg" alt="profile-cover" class="img-responsive cover" />
                      <div class="card-info">
                        <div class="friend-info">
                          <a href="groups-detail.html" class="pull-right text-red">Join</a>
                          <h5><a href="groups-detail.html" class="profile-link">Vegetarians and Vegans in Zurich</a></h5>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>-->
      </div>
    </div>
				<?php } ?>
    <!--======================Page Container STOP====================================-->
    <?php include 'footer.php' ?>
  </body>
</php>
