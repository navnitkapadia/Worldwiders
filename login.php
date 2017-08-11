<?php  
  session_start();
if($_SESSION['userid']){
    header('Location: index.php');
    exit;
}
?>
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
                FB.api('/me', 
                    {fields: "id,about,picture,birthday,email,gender,hometown,location,name"}, function (response) {
                    console.log('Successful login for: ' + response.name);
                    document.getElementById('status').innerHTML =
                            'Thanks for logging in, ' + response.name + '!';
                    function insert(response) {
                        var id = response.id;
                        var name = response.name;
                        var email = response.email;
                        var location = response.location.name;
                        var nationality = response.hometown.name;
                        var birthdate = response.birthday;
                        
                        $.ajax({
                            type: "POST",
                            url: "api/insert.php?action=login",
                            data: "name=" + name + "&email=" + email + "&userid="+ id +"&location="+ location +"&nationality="+ nationality +"&birthdate="+ birthdate
                        });
                    }
					insert(response);
                });
            }
			
            $(document).ready(function () {
                FB.init({
                    appId: '2100813633278010',
                    cookie: true,
                    xfbml: true,
                    version: 'v2.10'
                });
                checkLoginState();
            });
        </script>
    </head>

    <body>
        <?php include 'header.php';?>
        <div class="form-wrapper">
            <!-- Login form -->
            <form>
                <div class="flex-center flex-column">
                    <h1 class="animated fadeIn mb-4">World Widers</h1>
                    <div class="text-center">
                        <button class="btn btn-default">Login with facebook</button>
                    </div>
                    <div> 
                     <fb:login-button
                            scope="public_profile,email,user_birthday,user_hometown,user_location,user_about_me"
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
	