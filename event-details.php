<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/php; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="" />
        <meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
        <meta name="robots" content="index, follow" />
        <title>Event Details</title>


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
                            $Login_Id = $_SESSION['userid'];
                            $event_Id = $_GET['id'];
                            require 'api/db_config.php';
                            $sql = "SELECT e.created_by,u.name FROM event e,users u where e.id='" . $event_Id . "' and e.created_by=u.user_id";
                            $result = $mysqli->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                extract($row);
                                ?>
                                <img src="<?php echo "http://graph.facebook.com/$created_by/picture"; ?>" alt="user" class="profile-photo" />
                                <h5><a href="edit-profile.php" class="text-white"><?php echo $name; ?></a></h5>
                                <a href="#" class="text-white"><i class="ion ion-android-person-add"></i> 1,299 followers</a>
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
                                    <img src="upload/<?php echo $file; ?>" alt="" class="img-responsive post-image" />
                                </div>
                                <h3><?php echo $event; ?></h3>
                                <p><strong><?php echo $description; ?></strong></p>
                            <?php } ?>    
                            <?php
                            $com = "SELECT comment from event_comment where event_id='$event_Id'";
                            $result1 = $mysqli->query($com);
                            while ($row1 = $result1->fetch_assoc()) {
                                extract($row1);
                                ?>
                                <p id="comment"><?php echo $comment; ?></p>
                            <?php } ?>
                        </div>

                        <!-- Nearby People List
                        ================================================= -->
                        <!--<div class="people-nearby">
                            <div class="google-maps">
                                <div id="map" class="map"></div>
                            </div>
                        </div>-->


                        <!-- Post Create Box
                        ================================================= -->
                        <div class="create-post">
                            <div class="row">
                                <form method="post" action="post.php?id=<?php echo $event_Id ?>">
                                <div class="col-md-10 col-sm-10">
                                    <div class="form-group">
                                        <img src="<?php echo "http://graph.facebook.com/$Login_Id/picture"; ?>" alt="" class="profile-photo-md" />
                                        <textarea name="texts" id="texts" cols="50" rows="1" class="form-control" placeholder="Write what you wish"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <div class="tools">
                                        <button name="post" id="<?php echo $event_Id; ?>" class="btn btn-primary pull-right post">Publish</button>
                                    </div>
                                </div>
                                </form>
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
                            $sql = "SELECT e.user_id as user FROM event e where e.id='" . $event_Id . "'";
                            $result = $mysqli->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                extract($row);
                                $add = explode(",", $user);
                                if (in_array($_SESSION['userid'], $add)) {
                                    
                                } elseif ($flage == 2) {
                                    
                                } else {
                                    echo '<a href="update.php?id=' . $event_Id . '"<button type="button" class="btn btn-info">Join</button></a>';
                                }
                                ?>
                                <div class="follow-user">
                                    <?php
                                    for ($i = 0; $i < count($add); $i++) {
                                        $sql = "SELECT u.name,u.user_id FROM users u where u.user_id='" . $add[$i] . "'";
                                        $result = $mysqli->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                            extract($row);
                                            ?>
                                            <img src="<?php echo "http://graph.facebook.com/$user_id/picture"; ?>" alt="" class="profile-photo-sm pull-left" />
                                            <div>
                                                <h5><a href="profile.html"><?php echo $name; ?></a></h5>
                                                <a href="newsfeed-people-nearby.html#" class="text-green">Add friend</a>
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
    </body>
</html>
