<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/php; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="" />
        <meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
        <meta name="robots" content="index, follow" />
        <title>Event Details</title>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>    
    <script type="text/javascript">
        $(function() {
            $("#comment").load("post.php?action=comment&id=<?php echo $_GET['id']; ?>");
            $('.post').click(function(){
               var ids = this.id;
               var comment = $('.texts').val();
               $('.post').hide();
               $.ajax({
                type: 'post',
                url: "post.php?action=event-post",
                data: "id=" + ids + "&texts=" + comment,
                    success: function(data){
                    //clear the message box
                      $('.texts').val("");
                      $('#comment').load("post.php?action=comment&id="+ids);
                      $('.post').show();
                    }
                });
            });
        });
    </script>

    </head>
    <body>
        <?php include 'header.php' ?>    
        <!--======================Page Container START===================================-->
 
        <div id="page-contents">
            <div class="container">
                <div class="row">
                    
                    <!-- Newsfeed Common Side Bar Left
                    ================================================= -->
                    <div class="col-md-3 static">
                        <h4 style="margin-bottom: 30px;">Event organised by:</h4>
                        <div class="profile-card">
                            <?php
                            $addofmap  = "";
                            $Login_Id = $_SESSION['userid'];
                            $login = $_SESSION['fbid'];
                            $event_Id = $_GET['id'];
                            $sql = "SELECT e.location_address,e.created_by,u.name,u.fb_id FROM event e,users u where e.id='" . $event_Id . "' and e.created_by=u.user_id";
                            $result = $mysqli->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                extract($row);
                                $addofmap = $location_address;
                                ?>
                                <img src="<?php echo "http://graph.facebook.com/$fb_id/picture?type=large"; ?>" alt="user" class="profile-photo" />
                                <h5><a href="friends.php" class="text-white"><?php echo $name; ?></a></h5>
                                <?php 
                                    $sql = "SELECT count(*) as dost FROM friend_list where user_id = $created_by";
                                    $result = $mysqli->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                    extract($row);
                                ?>
                                <a href="#" class="text-white"><i class="ion ion-android-person-add"></i> <?php echo $dost; ?>&nbsp; followers</a>
                                <?php } ?>
                            <?php } ?>
                        </div><!--profile card ends-->

                    </div>
                    <div class="col-md-7">
                        <?php
                        $sql = "SELECT e.* FROM event e where e.id='" . $event_Id . "'";
                        $result = $mysqli->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            extract($row);
                            ?>
                            <div class="details">
                                <div class="img-wrapper">
                                    <img src="upload/<?php echo $file; ?>"  alt="" class="img-responsive post-image" />
                                </div>
                                <h3><?php echo $event; ?></h3>
                                <p><strong><?php echo date('d.m.Y , l', strtotime($start_date)); ?> Starting from:  <?php echo $start_time; ?></strong></p>
                                <p><strong><?php echo $description; ?></strong></p>
                            <?php } ?>    
                            
                        </div>

                        <!-- Nearby People List
                        ================================================= -->
                        <div class="people-nearby">
                            <div class="google-maps">
                                <div id="map" class="map"></div>
                            </div>
                        </div>


                        <!-- Post Create Box
                        ================================================= -->
                        <div class="create-post">
                            <br>
                            <div class="row">
                                <p id="comment"></p> 
                                <div class="col-md-10 col-sm-10">
                                    <div class="form-group">
                                        <img src="<?php echo "http://graph.facebook.com/$login/picture?type=large"; ?>" alt="" class="profile-photo-md" />
                                        <textarea name="texts" id="texts" cols="50" rows="1" class="form-control texts" placeholder="Write what you wish"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <div class="tools">
                                        <button name="post" id="<?php echo $event_Id; ?>" class="btn btn-primary pull-right post">Publish</button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Post Create Box End -->

                    </div>



                    <!-- Newsfeed Common Side Bar Right
                    ================================================= -->
                    <div class="col-md-2 static">
                        <div class="suggestions" id="sticky-sidebar">
                            <h4 class="grey">Who will go</h4>
                            <?php
                            $flage = 0;
                            $sql = "SELECT e.created_by as user FROM event e where e.id='" . $event_Id . "'";
                            $result = $mysqli->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                extract($row);
                                if ($user == $_SESSION['userid']) {
                                    $flage = 2;
                                }
                            }
                            ?>
                            <?php
                            $sql = "SELECT e.start_date as edate,e.user_id as user FROM event e where e.id='" . $event_Id . "'";
                            $result = $mysqli->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                extract($row);
                                $add = explode(",", $user);
                                if (in_array($_SESSION['userid'], $add)) {
                                    
                                } elseif ($flage == 2) {
                                     
                                } else {
                                    $current = new DateTime();
                                    $now = $current->format('Y-m-d');
                                    if($now < $edate) {
                                        echo '<a href="update.php?id=' . $event_Id . '"><button type="button" class="btn btn-info">Join</button></a>';
                                    } else {
                                        
                                    }
                                }
                                ?>
                                <div class="follow-user">
                                    <?php
                                    for ($i = 0; $i < count($add); $i++) {
                                        $sql = "SELECT u.user_id,u.name,u.fb_id FROM users u where u.user_id='" . $add[$i] . "'";
                                        $result = $mysqli->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                            extract($row);
                                            ?>
                                            <img src="<?php echo "http://graph.facebook.com/$fb_id/picture?type=large"; ?>" alt="" class="profile-photo-sm pull-left" />
                                            <div>
                                                <h5><a href="profile.php?id=<?php echo $user_id; ?>"><?php echo $name; ?></a></h5>
                                                <?php
                                                    $event1 = array();
                                                    $select = "SELECT friend_id from friend_list where user_id = '".$_SESSION['userid']."'";
                                                    $result = $mysqli->query($select);
                                                    while($row = $result->fetch_assoc()){
                                                        extract($row);
                                                        $event1[] = $friend_id;
                                                    }
                                                    if(in_array($add[$i], $event1)){
                                                ?>
                                                <a href="messages.php?friendid=<?php echo $user_id; ?>" class="text-green">Message</a>
                                                <?php } elseif($_SESSION['userid'] == $add[$i]){ ?>
                                                <a href="#" class="text-green"></a>
                                                <?php } else { ?>
                                                <a href="api/insert.php?action=addfriend&friendid=<?php echo $user_id; ?>" class="text-green">Add friend</a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--======================Page Container STOP====================================-->
        <?php include 'footer.php' ?>
        <script>
    function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 15,
  });
  var geocoder = new google.maps.Geocoder();
    geocodeAddress(geocoder, map);
}

function geocodeAddress(geocoder, resultsMap) {
  var address = "<?php echo $addofmap; ?>";
  geocoder.geocode({'address': address}, function(results, status) {
    if (status === 'OK') {
      resultsMap.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
        map: resultsMap,
        position: results[0].geometry.location
      });
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}
</script>

    <script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTMXfmDn0VlqWIyoOxK8997L-amWbUPiQ&callback=initMap">
  </script>
    </body>
</html>
