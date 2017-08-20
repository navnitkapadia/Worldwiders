 
 <?php session_start(); ?>
    <!-- Stylesheets
    ================================================= -->
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/ionicons.min.css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <link href="css/emoji.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">


      
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
    
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="images/fav.png"/>
       <!--preloader-->
    <div id="spinner-wrapper">
      <div class="spinner"></div>
    </div>
    <!-- Header
    ================================================= -->
    <header id="header">
      <nav class="navbar navbar-default navbar-fixed-top menu">
        <div class="container">

          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home.php"><img src="images/logo.png" alt="logo" /></a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right main-menu">
              <li class="dropdown"><a href="home.php">Home</a></li>
              <li class="dropdown"><a href="friends.php">Friends</a></li>
              <li class="dropdown"><a href="events.php">Events</a></li>
              <li class="dropdown"><a href="groups.php">Groups</a></li>
            </ul>
            <form class="navbar-form navbar-right hidden-sm">
              <div class="form-group">
                <i class="icon ion-android-search"></i>
                <input type="text" class="form-control" placeholder="Search friends, events, groups">
              </div>
            </form>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
      </nav>
    </header>
    <!--Header End-->

        <!-- Scripts
================================================= -->
  <script src="js/jquery-3.1.1.min.js"></script>
  <script type="text/javascript" src="//connect.facebook.net/en_US/sdk.js"></script>  
  <script src="js/login.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.sticky-kit.min.js"></script>
  <script src="js/jquery.scrollbar.min.js"></script>
  <script src="js/script.js"></script>