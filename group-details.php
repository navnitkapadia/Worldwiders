<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/php; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="" />
        <meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
        <meta name="robots" content="index, follow" />
        <title>Group Detail</title>
        <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                
            });
            function post(gid,tid,i){
                var comment = $('#desc-'+i).val();
                $.ajax({
                type: 'post',
                url: "post.php?action=topic_desc",
                data: {group:gid,topic:tid,comment:comment},
                    success: function(data){
                    //clear the message box
                    $('#desc-'+i).val("");
//                    resize();
                    }
                });
            };
//            function resize(){
//                group_id = $.trim($("#group_id").val());
//                var getdata = setInterval(function() {
//                    $(".open-"+group_id).load("group-details.php?id="+group_id);
//                }, 3000);
//            }
        </script>    

    </head>
    <body>
        <?php include 'header.php' ?>
        <!--======================Page Container START===================================-->
        <?php
        $i = 1;
        $group_Id = $_GET['id'];
        $user = $_SESSION['userid'];
        $login_id = $_SESSION['fbid'];
        $sql = "SELECT * FROM peoples_group where id='" . $group_Id . "'";
        $result = $mysqli->query($sql);
        while ($row = $result->fetch_assoc()) {
            extract($row);
            ?>
            <div id="page-contents">
                <div class="container">
                    <style> .timeline-cover{background-image: url("upload/<?php echo $file; ?>");}</style>   
                    <div class="timeline-cover">

                        <!--Timeline Menu for Large Screens-->
                        <div class="timeline-nav-bar hidden-sm hidden-xs">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="list-inline profile-menu">
                                        <li class="group-title"><?php echo $title; ?></li>
                                    </ul>
                                    <ul class="follow-me list-inline">
                                        <?php
                                        $join = 0;
                                        $sql = "SELECT count(*) as members FROM group_member where group_id='" . $group_Id . "'";
                                        $result = $mysqli->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                            extract($row);
                                            ?>  
                                            <li><?php echo $members ?>&nbsp;&nbsp;people in the group</li>
                                        <?php } ?>
                                        <?php
                                        $add = array();
                                        $sql = "SELECT user_id FROM group_member where group_id ='" . $group_Id . "'";
                                        $result = $mysqli->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                            extract($row);
                                            $add[] = $user_id;
                                        }
                                        if (in_array($_SESSION['userid'], $add)) {
                                            echo '<li><button class="btn-primary">Already Join</button></li>';
                                        } elseif ($join == 2) {
                                            
                                        } else {
                                            echo '<li><a href="update.php?gid=' . $group_Id . '"><button class="btn-primary">Join</button></a></li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!--Timeline Menu for Large Screens End-->

                    <!--Timeline Menu for Small Screens-->
                    <div class="navbar-mobile hidden-lg hidden-md">
                        <div class="profile-info">
                            <img src="images/users/user-1.jpg" alt="" class="img-responsive profile-photo" />
                            <h4>Sarah Cruiz</h4>
                            <p class="text-muted">Creative Director</p>
                        </div>
                        <div class="mobile-menu">
                            <ul class="list-inline">
                                <li><a href="timline.html">Timeline</a></li>
                                <li><a href="timeline-about.html">About</a></li>
                                <li><a href="timeline-album.html">Album</a></li>
                                <li><a href="timeline-friends.html" class="active">Friends</a></li>
                            </ul>
                            <button class="btn-primary">Add Friend</button>
                        </div>
                    </div><!--Timeline Menu for Small Screens End-->

                </div>
                <div class="row">

                    <!-- Newsfeed Common Side Bar Left
                    ================================================= -->
                    <div class="col-md-3 static">
                        <h4>Groups</h4>
                        <img src="http://www.jquery-az.com/wp-content/uploads/2016/04/16.0_1-JavaScript-date.png" style="width: 100%" />
                        <div class="suggestions" id="sticky-sidebar">
                            <h4>People in the group</h4>
                            <?php
                            $sql = "SELECT gm.id,gm.user_id as group_user,u.fb_id,u.name FROM group_member gm,users u where gm.user_id=u.fb_id and gm.user_id !='" . $_SESSION['fbid'] . "' and gm.group_id='$group_Id'";
                            $result = $mysqli->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                extract($row);
                                ?>
                                <div class="follow-user">
                                    <img src="<?php echo "http://graph.facebook.com/$group_user/picture"; ?>" alt="" class="profile-photo-sm pull-left" />
                                    <div>
                                        <h5><a href="timeline.html"><?php echo $name; ?></a></h5>
                                        <a href="home-logged.html" class="text-green">Add friend</a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-9">


                        <!-- Post Content
                        ================================================= -->
                        <div class="post-content <?php echo "open-$group_Id"; ?>">
                            <input type="hidden" id="group_id" value="<?php echo $group_Id; ?>">
                            <?php
                            $sql = "SELECT gt.topic, gt.id, gt.group_id as gID, u.fb_id,u.name, pg.description from group_topic gt, peoples_group pg, group_member gm, users u where gt.group_id = pg.id and gm.group_id = gt.group_id and gm.user_id = $user and u.user_id = gt.user_id and pg.id = $group_Id";
                            $result = $mysqli->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                extract($row);
                                echo "<h4>$topic</h4>";
                                ?>
                                <div class="post-container">
                                    <img src="<?php echo "http://graph.facebook.com/$fb_id/picture"; ?>" alt="user" class="profile-photo-md pull-left" />
                                    <div class="post-detail">
                                        <div class="user-info">
                                            <h5><a href="#" class="profile-link"><?php echo $name; ?></a> <span class="following">following</span></h5>
                                            <p class="text-muted">Published a photo about 3 mins ago</p>
                                        </div>
                                        <div class="reaction">
                                            <a class="btn text-green"><i class="icon ion-thumbsup"></i> 13</a>
                                            <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a>
                                        </div>
                                        <div class="line-divider"></div>
                                        <div class="post-text">
                                            <p> <?php echo $description; ?> </p>
                                        </div>
                                        <?php
                                        $select = "SELECT td.*,u.name,u.fb_id from topic_desc td,peoples_group pg,users u where td.group_id=" . $row['gID'] . " and td.topic_id =" . $row['id'] . "  and pg.id=td.group_id and u.user_id=td.user_id order by td.id asc";
                                        $result2 = $mysqli->query($select);
                                        $post = 1;
                                        while ($row2 = $result2->fetch_assoc()) {
                                            extract($row2);
                                            ?>
                                            <div class="line-divider"></div>
                                            <div class="post-comment">
                                                <img src="<?php echo "http://graph.facebook.com/$fb_id/picture"; ?>" alt="" class="profile-photo-sm" />
                                                <p><a href="#" class="profile-link"><?php echo $name; ?></a> <?php echo $comment; ?> </p>
                                            </div>
                                        <?php } ?>
                                        <?php if ($post == 1) { ?>
                                            <!--<form name="group" id="group" method="post">-->
                                                <div class="post-comment">
                                                    <img src="<?php echo "http://graph.facebook.com/$login_id/picture"; ?>" alt="" class="profile-photo-sm" />
                                                    <input type="text" name="desc" id="desc-<?php echo $i; ?>" class="form-control" placeholder="Post a comment">
                                                    <input type="button" name="comment" id="comment-<?php echo $i; ?>" onclick="post(<?php echo $group_id; ?>,<?php echo $topic_id ?>,<?php echo $i; ?>);" class="btn btn-primary pull-right" value="Publish">
                                                </div>
                                            <?php $i++; ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--======================Page Container STOP====================================-->
        <?php include 'footer.php' ?>
    </body>
</html>
