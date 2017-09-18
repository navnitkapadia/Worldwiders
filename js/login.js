$(document).ready(function () {
    FB.init({
        appId: '1740052789628613',
        cookie: true,
        xfbml: true,
        version: 'v2.10'
    });

    checkLoginState();
});
function checkLoginState() {
    FB.getLoginStatus(function (response) {
        statusChangeCallback(response);
    });
}
function statusChangeCallback(response) {
        if (response.status === 'connected') {
            $.ajax({
                type: "POST",
                url: "api/checklogin.php",
                data: "fbid=" + response.authResponse.userID + "&accesstoken=" + response.authResponse.accessToken +"&cover=",
                success: function (data) {
                    if(data == 0 ){
                        user_signup(); 
                        return;
                    }
                    if(window.location.pathname == "/"){
                        window.location = "home.php"
                    }
                    
            }
          });
          return;
        } 
        if (response.status === 'not_authorized') {
            FB.login(function (response) {
                statusChangeCallback2(response);
            }, {scope: 'public_profile,email'});
        } else {
            if(window.location.pathname != "/"){
                window.location = "/"
            }
        }
      }
      function statusChangeCallback2(response) {
         $.ajax({
            type: "POST",
            url: "api/checklogin.php",
            data: "userid=" + response.authResponse.userID,
            success: function (data) {
                if(data == 0 ){
                    user_signup(); 
                }
            }
          });
      }
      function user_signup() {
        console.log('Welcome! Fetching your information.... ');
        FB.api('/me', 
            {fields: "id,about,cover,first_name,last_name,picture,birthday,email,hometown,location,name"}, function (response) {
            insert(response);
            console.log(response);
            function insert(response) {
              var id = response.id;
              var name = response.name;
              var first_name = response.first_name;
              var last_name = response.last_name;
              var email = response.email;
              if(response.location){
                 var location = response.location.name;
              } else{
                var location = "";
              }
             if(response.cover){
                 var cover = response.cover.source;
              } else{
                var cover = "";
              }
             if(response.hometown){
                 var nationality = response.hometown.name;
              } else{
                var nationality = "";
              }
              var birthdate = response.birthday;
              $.ajax({
                  type: "POST",
                  url: "api/insert.php?action=login",
                  data: "name=" + name + "&email=" + email+"&first_name=" + first_name+"&last_name=" + last_name + "&cover=" + cover + "&userid="+ id +"&location="+ location +"&nationality="+ nationality +"&birthdate="+ birthdate,
                  success: function (data) {
                    $.ajax({
                        type: "POST",
                        url: "api/checklogin.php",
                        data: "fbid=" + response.authResponse.userID + "&accesstoken=" + response.authResponse.accessToken,
                        success: function (data) {
                            if(data == 0 ){
                                user_signup(); 
                                return;
                            }
                            if(window.location.pathname == "/"){
                                window.location = "home.php"
                            }
                        }
                    });
                  }
              });
            }
        });
      }
