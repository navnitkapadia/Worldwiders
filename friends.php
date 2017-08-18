<!DOCTYPE php>
<php lang="en">
	<head>
    <meta http-equiv="content-type" content="text/php; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="" />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
		<meta name="robots" content="index, follow" />
		<title>My Friends</title>


	</head>
  <body>
    <?php include 'header.php'?>
    <!--======================Page Container START===================================-->


    <div class="container">

      <!-- Timeline
      ================================================= -->
      <div class="timeline">
        <div class="timeline-cover">

          <!--Timeline Menu for Large Screens-->
          <div class="timeline-nav-bar hidden-sm hidden-xs">
            <div class="row">
              <div class="col-md-3">
                <div class="profile-info">
                  <img src="images/users/user-1.jpg" alt="" class="img-responsive profile-photo" />
                  <h3>Sarah Cruiz</h3>
                  <p class="text-muted">Creative Director</p>
                </div>
              </div>
              <div class="col-md-9">
                <ul class="list-inline profile-menu">
                  <li><a href="profile.php">About</a></li>
                  <li><a href="friends.php" class="active">Friends</a></li>
                </ul>
                <ul class="follow-me list-inline">
                  <li>1,299 people following her</li>
                  <li><button class="btn-primary">Add Friend</button></li>
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
                  <div class="col-md-4 col-sm-4">
                    <div class="friend-card">
                      <img src="images/covers/1.jpg" alt="profile-cover" class="img-responsive cover" />
                      <div class="card-info">
                        <img src="images/users/user-3.jpg" alt="user" class="profile-photo-lg" />
                        <div class="friend-info">
                          <a href="friends.php" class="pull-right text-green">My Friend</a>
                          <h5><a href="timeline.php" class="profile-link">Sophia Lee</a></h5>
                          <p>Student at Harvard</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <div class="friend-card">
                      <img src="images/covers/3.jpg" alt="profile-cover" class="img-responsive cover" />
                      <div class="card-info">
                        <img src="images/users/user-4.jpg" alt="user" class="profile-photo-lg" />
                        <div class="friend-info">
                          <a href="friends.php" class="pull-right text-green">My Friend</a>
                          <h5><a href="timeline.php" class="profile-link">John Doe</a></h5>
                          <p>Traveler</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <div class="friend-card">
                      <img src="images/covers/4.jpg" alt="profile-cover" class="img-responsive cover" />
                      <div class="card-info">
                        <img src="images/users/user-10.jpg" alt="user" class="profile-photo-lg" />
                        <div class="friend-info">
                          <a href="timeline.php" class="pull-right text-green">My Friend</a>
                          <h5><a href="friends.php" class="profile-link">Julia Cox</a></h5>
                          <p>Art Designer</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <div class="friend-card">
                      <img src="images/covers/5.jpg" alt="profile-cover" class="img-responsive cover" />
                      <div class="card-info">
                        <img src="images/users/user-7.jpg" alt="user" class="profile-photo-lg" />
                        <div class="friend-info">
                          <a href="friends.php" class="pull-right text-green">My Friend</a>
                          <h5><a href="profile.php" class="profile-link">Robert Cook</a></h5>
                          <p>Photographer</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <div class="friend-card">
                      <img src="images/covers/6.jpg" alt="profile-cover" class="img-responsive cover" />
                      <div class="card-info">
                        <img src="images/users/user-8.jpg" alt="user" class="profile-photo-lg" />
                        <div class="friend-info">
                          <a href="friends.php" class="pull-right text-green">My Friend</a>
                          <h5><a href="timeline.php" class="profile-link">Richard Bell</a></h5>
                          <p>Graphic Designer</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <div class="friend-card">
                      <img src="images/covers/7.jpg" alt="profile-cover" class="img-responsive cover" />
                      <div class="card-info">
                        <img src="images/users/user-2.jpg" alt="user" class="profile-photo-lg" />
                        <div class="friend-info">
                          <a href="friends.php" class="pull-right text-green">My Friend</a>
                          <h5><a href="timeline.php" class="profile-link">Linda Lohan</a></h5>
                          <p>Software Engineer</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <div class="friend-card">
                      <img src="images/covers/8.jpg" alt="profile-cover" class="img-responsive cover" />
                      <div class="card-info">
                        <img src="images/users/user-9.jpg" alt="user" class="profile-photo-lg" />
                        <div class="friend-info">
                          <a href="friends.php" class="pull-right text-green">My Friend</a>
                          <h5><a href="timeline.php" class="profile-link">Anna Young</a></h5>
                          <p>Musician</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <div class="friend-card">
                      <img src="images/covers/9.jpg" alt="profile-cover" class="img-responsive cover" />
                      <div class="card-info">
                        <img src="images/users/user-6.jpg" alt="user" class="profile-photo-lg" />
                        <div class="friend-info">
                          <a href="friends.php" class="pull-right text-green">My Friend</a>
                          <h5><a href="timeline.php" class="profile-link">James Carter</a></h5>
                          <p>CEO at IT Farm</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <div class="friend-card">
                      <img src="images/covers/10.jpg" alt="profile-cover" class="img-responsive cover" />
                      <div class="card-info">
                        <img src="images/users/user-5.jpg" alt="user" class="profile-photo-lg" />
                        <div class="friend-info">
                          <a href="friends.php" class="pull-right text-green">My Friend</a>
                          <h5><a href="timeline.php" class="profile-link">Alexis Clark</a></h5>
                          <p>Traveler</p>
                        </div>
                      </div>
                    </div>
                  </div>
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
</php>
