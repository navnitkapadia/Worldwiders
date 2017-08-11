
<html>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '2100813633278010',
      xfbml      : true,
      version    : 'v2.10'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));


function basicAPIRequest() {
    FB.api('/me', 
        {fields: "id,about,picture,birthday,email,gender,hometown,locations,name"}, 
        function(response) {
          console.log('API response', response);
          $("#fb-profile-picture").append('<img src="' + response.picture.data.url + '"> ');
          $("#name").append(response.name);
          $("#user-id").append(response.id);
          $("#work").append(response.gender);
          $("#birthday").append(response.birthday);
          $("#education").append(response.hometown);
        }
    );
  }
jQuery(document).ready(function(){
  jQuery("#load").click(function(e){
    if(typeof(FB) == "undefined") {
        alert("Facebook SDK not yet loaded please wait.")
      }
    FB.getLoginStatus(function(response) {
      if (response.status === 'connected') {
        console.log('Logged in.');
        basicAPIRequest();

      }
      else {
        FB.login();
      }
    });      
  });

});
</script>
fb-profile-picture: <div id="fb-profile-picture"></div>
name: <div id="name"></div>
user-id: <div id="user-id"></div>
work: <div id="work"></div>
birthday: <div id="birthday"></div>
education: <div id="education"></div>

<p>1) Click login</p>
<div class="fb-login-button" data-scope="email,user_birthday,user_hometown,user_location,user_about_me
" data-max-rows="1" data-size="medium" data-show-faces="false" data-auto-logout-link="false"></div>
<p>2) Click load data</p>
<button id='load'>Load data</button>
</html>
<!-- <html>
<head>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  <script type="text/javascript" src="//connect.facebook.net/en_US/sdk.js"></script> 
  <link rel="stylesheet" href="style.css" />
  <title>jQuery Example</title>
  <script>
         function statusChangeCallback(response) {
                // console.log('statusChangeCallback');
                // console.log(response);
                      FB.login(function (response) {
                        console.log(response);
                    }, {scope: 'email,user_about_me'});
                    
                if (response.status === 'connected') {
            
                    testAPI();

                } else if (response.status === 'not_authorized') {
                    FB.login(function (response) {
                        statusChangeCallback2(response);
                    }, {scope: 'email,user_about_me'});

                } else {
                    alert("not connected, not logged into facebook, we don't know");
                }
            }
    function statusChangeCallback2(response) {
        // console.log('statusChangeCallback2');
        // console.log(response);
        if (response.status === 'connected') {
            testAPI();

        } else if (response.status === 'not_authorized') {
            console.log('still not authorized!');

        } else {
            alert("not connected, not logged into facebook, we don't know");
        }
    }
         function testAPI() {
                console.log('Welcome! Fetching your information.... ');
                FB.api('/me?fields=id,name,email,first_name,last_name,picture,link,age_range,locale,timezone,verified,cover,updated_time', function (response) {
                    console.log('Successful login for: ' + response.name);
                    document.getElementById('status').innerHTML =
                            'Thanks for logging in, ' + response.name + '!';
                    function insert(response) {
                        var name = response.name;
                        var email = response.email;
                        var id = response.id;
                        $.ajax({
                            type: "GET",
                            url: "api/insert.php?action=login",
                            data: "name=" + name + "&email=" + email +  "&prfile-image=http://graph.facebook.com/"+id+"/picture?type=large",
                            success: function (data) {
                            }
                        });
                    }
                    console.log(response);
					insert(response);
                });
            }
  $(document).ready(function() {
  $.ajaxSetup({ cache: true });
    FB.init({
    appId: '280405305768793',
    cookie: true,
    xfbml: true,
      version: 'v2.9' // or v2.1, v2.2, v2.3, ...
    });     
    FB.getLoginStatus(function (response) {
        statusChangeCallback(response);
    });
});
  </script>
</head>
<body>
     <div> <fb:login-button
                            scope="public_profile,email"
                            onlogin="checkLoginState();">
                        </fb:login-button>
                    </div>
                    <div id="status"></div>
</body>
</html> -->