<!DOCTYPE php>
<php lang="en">
	<head>
		<meta http-equiv="content-type" content="text/php; charset=iso-8859-1" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Worldwiders" />
		<meta name="keywords" content="Worldwiders" />
		<meta name="robots" content="index, follow" />
		<title>Worldwiders</title>

    <!-- Stylesheets
    ================================================= -->
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/ionicons.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
    
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="images/fav.png"/>
	</head>
	<body>

    <!-- Header
    ================================================= -->
		<header id="header-inverse">
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
            <a class="navbar-brand" href="index-register.php"><img src="images/logo.png" alt="logo" /></a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right main-menu">
				<li class="dropdown"><a href="index.php">Home</a></li>
              <li class="dropdown"><a href="contact.php">Contact</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
      </nav>
    </header>
    <!--Header End-->
    
    <!-- Landing Page Contents
    ================================================= -->
    <div id="lp-register">
    	<div class="container wrapper">
        <div class="row">
        	<div class="col-sm-5">
            <div class="intro-texts">
            	<h1 class="text-white">Welcome to the biggest and most active group in Zurich!!!</h1>
            	<p>This group is created for friendly international and Swiss people living in the area of Zürich. Here you can make friends, exchange information, post events and have a good time together.</p>
            </div>
          </div>
        	<div class="col-sm-6 col-sm-offset-1">
            <div class="reg-form-container"> 
            
              <!-- Register/Login Tabs-->
              <div class="reg-options">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="index-register.php#register" data-toggle="tab">Register</a></li>
                  <li><a href="index-register.php#login" data-toggle="tab">Login</a></li>
                </ul><!--Tabs End-->
              </div>
              
              <!--Registration Form Contents-->
              <div class="tab-content">
                <div class="tab-pane active" id="register">
                  <h3>Register Now!</h3>
                  <p class="text-muted">Use your Facebook account to register or to login. Be cool and join today.</p>
                  
                  <p><a href="home-logged.php"><img src="https://www.inyoursoup.com/images/signup-with-facebook-button.png" style="width: 100%" /></a></p>
                  
                  <p>or already have an account?</p>
                    <fb:login-button
                      scope="public_profile,email,user_birthday,user_hometown,user_location,user_about_me"
                      onlogin="checkLoginState();">
                    </fb:login-button>
                </div><!--Registration Form Contents Ends-->
                
                <!--Login-->
                <div class="tab-pane" id="login">
                  <h3>Login</h3>
                  <p class="text-muted">Log into your account</p>
                      <fb:login-button
                          scope="public_profile,email,user_birthday,user_hometown,user_location,user_about_me"
                          onlogin="checkLoginState();">
                      </fb:login-button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-sm-offset-6">
          
            <!--Social Icons-->
            <ul class="list-inline social-icons">
              <li><a href="index-register.php#"><i class="icon ion-social-facebook"></i></a></li>
              <li><a href="index-register.php#"><i class="icon ion-social-twitter"></i></a></li>
              <li><a href="index-register.php#"><i class="icon ion-social-googleplus"></i></a></li>
              <li><a href="index-register.php#"><i class="icon ion-social-pinterest"></i></a></li>
              <li><a href="index-register.php#"><i class="icon ion-social-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!--preloader-->
    <div id="spinner-wrapper">
      <div class="spinner"></div>
    </div>

    <!-- Scripts
    ================================================= -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.appear.min.js"></script>
    <script src="js/script.js"></script>
    <script type="text/javascript" src="//connect.facebook.net/en_US/sdk.js"></script>
    <script type="text/javascript" src="js/login.js"></script>
	</body>
</php>
