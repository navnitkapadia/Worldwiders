<?php 
    require 'api/db_config.php';
    session_start();
    
?>

   <link rel="stylesheet" href="assets/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <!-- Stylesheets
    ================================================= -->
	<!-- <link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/ionicons.min.css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <link href="css/emoji.css" rel="stylesheet">-->
  <link href="css/custom.css" rel="stylesheet"> 


      
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
    
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="images/fav.png"/>
  <script src="js/jquery-3.1.1.min.js"></script>
   <script type="text/javascript" src="//connect.facebook.net/en_US/sdk.js"></script>
   <script src="js/login.js"></script> 
    <!-- Header
    ================================================= -->
    <header id="header">

    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="../home.php" class="navbar-brand"><img src="assets/images/logo.png" alt="logo"/></a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav navbar-right">
              <li><a href="home.php">Home</a></li>
              <li><a href="friends.php">Friends</a></li>
              <li><a href="events.php">Events</a></li>
              <li><a href="groups.php">Groups</a></li>
              <li class="active"><a href="logout.php">Logout</a></li>
          </ul>
          
          <form class="navbar-form navbar-right hidden-sm search-top">
			  <div class="form-group">
				<i class="fa fa-search icon" aria-hidden="true"></i>
				<input type="text" id="searchany" class="form-control" placeholder="Search friends, events, groups">
				<div class="search-box">
				  <ul id="searchlist">  
				  </ul>
				</div>
			  </div>
			</form>
           
        </div>

      </div>
    </div>
    </header> 
    <!--Header End-->