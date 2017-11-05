<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/php; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="" />
        <meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
        <meta name="robots" content="index, follow" />
        <title>Events</title>
        <style>
        .event a {
            background-color: #5FBA7D !important;
            color: #ffffff !important;
        }
</style> 

    </head> 
    <body>
        <?php include 'header.php' ?>
        <!--======================Page Container START===================================-->

        <div class="container">
		<div class="row">
        	<div class="col-lg-3 col-md-3 col-sm-4">
                <?php include 'homemenu.php' ?>
     		</div>
     		<div class="col-lg-7 col-md-7 col-sm-5" id="page-content">
				  <div class="bs-docs-section clearfix">
					<div class="row">
					  <div class="col-lg-12">
					  	<div class="calendar">
					  		<h3>Calendar</h3>
					  		<div id="datepicker" class="calendar"></div>
					  	</div>
					  
                        <h3>Selected events</h3>
                        <div id="getevents" class="media">
                            
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
    		<div class="col-lg-2 col-md-2 col-sm-3">
    			<div id="right-content" class="right-content">
					<div class="row">
						<div class="col-sm-12">
							<h2>People you may know...</h2>
							<div class="people-item">
								<div class="col-sm-3 image"><img src="http://graph.facebook.com/1364909596950234/picture" class="img-responsive img-circle" /></div>
								<div class="col-sm-9">
									<p class="user"><a href="#">Luiis Franceschi</a></p>
									<p><a href="#" class="btn btn-info">Add friend</a></p>
								</div>
							</div>
							<div class="people-item">
								<div class="col-sm-3 image"><img src="http://graph.facebook.com/1364909596950234/picture" class="img-responsive img-circle" /></div>
								<div class="col-sm-9">
									<p class="user"><a href="#">Luiis Franceschi</a></p>
									<p><a href="#" class="btn btn-info">Add friend</a></p>
								</div>
							</div>
							<div class="people-item">
								<div class="col-sm-3 image"><img src="http://graph.facebook.com/1364909596950234/picture" class="img-responsive img-circle" /></div>
								<div class="col-sm-9">
									<p class="user"><a href="#">Luiis Franceschi</a></p>
									<p><a href="#" class="btn btn-info">Add friend</a></p>
								</div>
							</div>
							<div class="people-item">
								<div class="col-sm-3 image"><img src="http://graph.facebook.com/1364909596950234/picture" class="img-responsive img-circle" /></div>
								<div class="col-sm-9">
									<p class="user"><a href="#">Luiis Franceschi</a></p>
									<p><a href="#" class="btn btn-info">Add friend</a></p>
								</div>
							</div>
							<div class="people-item">
								<div class="col-sm-3 image"><img src="http://graph.facebook.com/1364909596950234/picture" class="img-responsive img-circle" /></div>
								<div class="col-sm-9">
									<p class="user"><a href="#">Luiis Franceschi</a></p>
									<p><a href="#" class="btn btn-info">Add friend</a></p>
								</div>
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































        <!-- <div id="page-contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 static">
                    <div id="datepicker" class="calendar"></div>
                    </div>
                    <div class="col-md-9">

                        <!-- Media
                        ================================================= -->
                        <!--<div id="getevents" class="media">
                            
                        </div> 
                    </div>
                </div>
            </div>
        </div> -->
        <!--======================Page Container STOP====================================-->
<?php include 'footer.php' ?>
<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<div id="datepi"></div> 

<script>
$("#getevents").load("api/getEvents.php");
$("#datepi").load("api/GetEventsDates.php");
</script>
    </body>
</html>
