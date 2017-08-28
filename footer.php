
  <!--preloader-->
    <div id="spinner-wrapper">
      <div class="spinner"></div>
    </div>

  <!-- Footer
    ================================================= -->
    <footer id="footer">
      <div class="container">
      	<div class="row">
          <div class="footer-wrapper">
            <div class="col-md-3 col-sm-3">
              <a href=""><img src="images/logo-black.png" alt="" class="footer-logo" /></a>
              <ul class="list-inline social-icons">
              	<li><a href="home-logged.html"><i class="icon ion-social-facebook"></i></a></li>
              	<li><a href="home-logged.html"><i class="icon ion-social-twitter"></i></a></li>
              	<li><a href="home-logged.html"><i class="icon ion-social-googleplus"></i></a></li>
              	<li><a href="home-logged.html"><i class="icon ion-social-pinterest"></i></a></li>
              	<li><a href="home-logged.html"><i class="icon ion-social-linkedin"></i></a></li>
              </ul>
            </div>
            <div class="col-md-2 col-sm-2">
              <h5>Member</h5>
              <ul class="footer-links">
                <li><a href="">Your profile</a></li>
                <li><a href="">Groups</a></li>
                <li><a href="">Events</a></li>
              </ul>
            </div>
            <div class="col-md-2 col-sm-2">
              <h5>For businesses</h5>
              <ul class="footer-links">
                <li><a href="">Advertise</a></li>
              </ul>
            </div>
            <div class="col-md-2 col-sm-2">
              <h5>About</h5>
              <ul class="footer-links">
                <li><a href="">About us</a></li>
                <li><a href="">Contact us</a></li>
                <li><a href="">Privacy Policy / Terms</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-sm-3">
              <h5>Contact Us</h5>
              <ul class="contact">
                <li><i class="icon ion-ios-email-outline"></i>info@worlwiders.com</li>
              </ul>
            </div>
          </div>
      	</div>
      </div>
      <div class="copyright">
        <p>© 2017 - 2018 Worldwide People. All rights reserved</p>
      </div>
		</footer>
            <!-- Scripts
================================================= -->
  <script src="js/jquery-3.1.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.sticky-kit.min.js"></script>
  <script src="js/jquery.scrollbar.min.js"></script>
  <script src="js/script.js"></script>
   <script type="text/javascript" src="//connect.facebook.net/en_US/sdk.js"></script>
   <script src="js/login.js"></script> 

   <script>
    $(window).on('hashchange ready keypress blur change mousedown', function (e) {
      console.log(e);
        $.ajax({
            type: "POST",
            url: "api/activity.php",
      });
    });
  </script>