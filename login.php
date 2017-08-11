<!-- https://developers.facebook.com/docs/facebook-login/permissions/#reference-public_profile  -> Graph API --> 
<!-- https://developers.facebook.com/docs/graph-api -->
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Demo page template</title>
        <?php include 'styles.php' ?>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="//connect.facebook.net/en_US/sdk.js"></script>       	
        <script>

            function statusChangeCallback(response) {
                console.log('statusChangeCallback');
                console.log(response);
                if (response.status === 'connected') {
                    testAPI();

                } else if (response.status === 'not_authorized') {
                    FB.login(function (response) {
                        statusChangeCallback2(response);
                    }, {scope: 'public_profile,email'});

                } else {
                    alert("not connected, not logged into facebook, we don't know");
                }
            }

            function statusChangeCallback2(response) {
                console.log('statusChangeCallback2');
                console.log(response);
                if (response.status === 'connected') {
                    testAPI();

                } else if (response.status === 'not_authorized') {
                    console.log('still not authorized!');

                } else {
                    alert("not connected, not logged into facebook, we don't know");
                }
            }

            function checkLoginState() {
                FB.getLoginStatus(function (response) {
                    statusChangeCallback(response);
                });
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
                        var first_name = response.first_name;
                        var last_name = response.last_name;
                        var age_range = response.age_range;
                        var locale = response.locale;
                        var timezone = response.timezone;
                        var verified = response.verified;
                        var cover = response.cover;
                        var updated_time = response.updated_time;
                        $.ajax({
                            type: "POST",
                            url: "insert.php",
                            data: "name=" + name + "&email=" + email + "&first_name=" + first_name + "&last_name=" + last_name + "&age_range=" + age_range + "&locale=" + locale + "&timezone=" + timezone + "&verified=" + verified + "&cover=" + cover + "&updated_time=" + updated_time,
                            success: function (data) {
                                alert("sucess");
                            }
                        });
                    }
					insert(response);
                });
            }
			
            $(document).ready(function () {
                FB.init({
                    appId: '232279197294576',
                    cookie: true,
                    xfbml: true,
                    version: 'v2.8'
                });
                checkLoginState();
            });
        </script>
    </head>

    <body>
        <?php include 'header.php';
		 print_r($_POST);
		?>
        <div class="form-wrapper">
            <!-- Login form -->
            <form>
                <div class="flex-center flex-column">
                    <h1 class="animated fadeIn mb-4">World Widers</h1>
                    <div class="text-center">
                        <button class="btn btn-default">Login with facebook</button>
                    </div>
                    <div> <fb:login-button
                            scope="public_profile,email"
                            onlogin="checkLoginState();">
                        </fb:login-button>
                    </div>
                    <div id="status"></div>
                </div>  
            </form>
            <!-- Login form -->
        </div>


        <?php include 'footer.php' ?>
        <?php include 'scripts.php' ?>
    </body>
</html>
	