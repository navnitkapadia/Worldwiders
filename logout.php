<?php
    session_start();
    session_destroy();
    session_unset();
?>

<script src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="//connect.facebook.net/en_US/sdk.js"></script>
<script>
$(document).ready(function () {
    FB.init({
        appId: '1740052789628613',
        cookie: true,
        xfbml: true,
        version: 'v2.10'
    });
    FB.getLoginStatus(function (response) {
        callLogout(response);
    });
    function callLogout(response){
        FB.logout(function(logout) {
            if (logout.status === 'unknown') {
            if(window.location.pathname != "/"){
                window.location = "/"
            }
            console.log(logout);
            }
        });
    }
  
});

</script>
