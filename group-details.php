<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/php; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="" />
        <meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
        <meta name="robots" content="index, follow" />
        <title>Group Detail</title>


    </head>
    <body>
        <?php include 'header.php' ?>
        <!--======================Page Container START===================================-->
        <?php
        $group_Id = $_GET['id'];
        $user = $_SESSION['fbid'];
        require 'api/db_config.php';
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
                                        $sql = "SELECT user_id FROM peoples_group where id ='" . $group_Id . "'";
                                        $result = $mysqli->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                            extract($row);
                                            if ($user_id == $_SESSION['fbid']) {
                                                $join = 2;
                                                echo '<li><button class="btn-primary">Already Join</button></li>';
                                            }
                                        }
                                        $add = array();
                                        $sql = "SELECT user_id FROM group_member where group_id ='" . $group_Id . "'";
                                        $result = $mysqli->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                            extract($row);
                                            $add[] = $user_id;
                                        }
                                        if(in_array($_SESSION['fbid'], $add)){
                                            echo '<li><button class="btn-primary">Already Join</button></li>';
                                        } elseif($join == 2) {
                                            
                                        } else{
                                            echo '<li><a href="update.php?gid='.$group_Id.'"><button class="btn-primary">Join</button></a></li>';
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
                                <!--                                <div class="follow-user">
                                                                    <img src="images/users/user-12.jpg" alt="" class="profile-photo-sm pull-left" />
                                                                    <div>
                                                                        <h5><a href="timeline.html">Cris Haris</a></h5>
                                                                        <a href="home-logged.html" class="text-green">Add friend</a>
                                                                    </div>
                                                                </div>
                                                                <div class="follow-user">
                                                                    <img src="images/users/user-13.jpg" alt="" class="profile-photo-sm pull-left" />
                                                                    <div>
                                                                        <h5><a href="timeline.html">Brian Walton</a></h5>
                                                                        <a href="home-logged.html" class="text-green">Add friend</a>
                                                                    </div>
                                                                </div>
                                                                <div class="follow-user">
                                                                    <img src="images/users/user-14.jpg" alt="" class="profile-photo-sm pull-left" />
                                                                    <div>
                                                                        <h5><a href="timeline.html">Olivia Steward</a></h5>
                                                                        <a href="home-logged.html" class="text-green">Add friend</a>
                                                                    </div>
                                                                </div>
                                                                <div class="follow-user">
                                                                    <img src="images/users/user-15.jpg" alt="" class="profile-photo-sm pull-left" />
                                                                    <div>
                                                                        <h5><a href="timeline.html">Sophia Page</a></h5>
                                                                        <a href="home-logged.html" class="text-green">Add friend</a>
                                                                    </div>
                                                                </div>-->
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-9">


                        <!-- Post Content
                        ================================================= -->
                        <div class="post-content">
                            <?php
                            $sql = "SELECT topic FROM peoples_group where id=$group_Id";
                            $result = $mysqli->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                extract($row);
                                echo "<h4>$topic</h4>";
                            }
                            ?>
                            <div class="post-container">
                                <?php
                                $select = "SELECT td.*,u.name From topic_desc td,users u where td.group_id=$group_Id and u.user_id=td.user_id order by td.id asc";
                                $result2 = $mysqli->query($select);
                                $flag = true;
                                while($row2 = $result2->fetch_assoc()){
                                    extract($row2);
                                    if ($flag) {
                                        $flag = false;
                                ?>
                                <img src="<?php echo "http://graph.facebook.com/$user/picture"; ?>" alt="user" class="profile-photo-md pull-left" />
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
                                        <p> <?php echo $comment; ?> </p>
                                    </div>
                                  <?php } else { ?>
                                    <div class="line-divider"></div>
                                    <div class="post-comment">
                                        <img src="<?php echo "http://graph.facebook.com/$user_id/picture"; ?>" alt="" class="profile-photo-sm" />
                                        <p><a href="#" class="profile-link"><?php echo $name; ?></a> <?php echo $comment; ?> </p>
                                    </div>
                                    <!--<div class="post-comment">
                                        <img src="images/users/user-4.jpg" alt="" class="profile-photo-sm" />
                                        <p><a href="timeline.html" class="profile-link">John</a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud </p>
                                    </div>-->
                                <?php } } ?>
                                    <form method="post" action="post.php?gid=<?php echo $group_Id; ?>">
                                    <div class="post-comment">
                                        <img src="<?php echo "http://graph.facebook.com/$user/picture"; ?>" alt="" class="profile-photo-sm" />
                                        <input type="text" name="desc" id="desc" class="form-control" placeholder="Post a comment">
                                        <input type="submit" name="comment" id="comment" class="btn btn-primary pull-right" value="Publish">
                                    </div>
                                    </form>    
                                </div>
                            </div>
                        </div>

                        <!-- Post Content
                        ================================================= -->
<!--                        <div class="post-content">
                            <h4>Aupair</h4>
                            <div class="post-container">
                                <img src="images/users/user-3.jpg" alt="user" class="profile-photo-md pull-left" />
                                <div class="post-detail">
                                    <div class="user-info">
                                        <h5><a href="timeline.html" class="profile-link">Sophia Lee</a> <span class="following">following</span></h5>
                                        <p class="text-muted">Updated her status about 33 mins ago</p>
                                    </div>
                                    <div class="reaction">
                                        <a class="btn text-green"><i class="icon ion-thumbsup"></i> 75</a>
                                        <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 8</a>
                                    </div>
                                    <div class="line-divider"></div>
                                    <div class="post-text">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                    </div>
                                    <div class="line-divider"></div>
                                    <div class="post-comment">
                                        <img src="images/users/user-14.jpg" alt="" class="profile-photo-sm" />
                                        <p><a href="timeline.html" class="profile-link">Olivia </a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <i class="em em-anguished"></i> Ut enim ad minim veniam, quis nostrud </p>
                                    </div>
                                    <div class="post-comment">
                                        <img src="images/users/user-1.jpg" alt="" class="profile-photo-sm" />
                                        <p><a href="timeline.html" class="profile-link">Sarah</a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                                    </div>
                                    <div class="post-comment">
                                        <img src="images/users/user-2.jpg" alt="" class="profile-photo-sm" />
                                        <p><a href="timeline.html" class="profile-link">Linda</a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                    <div class="post-comment">
                                        <img src="images/users/user-1.jpg" alt="" class="profile-photo-sm" />
                                        <input type="text" class="form-control" placeholder="Post a comment">
                                    </div>
                                </div>
                            </div>
                        </div>-->


                        <!-- Post Content
                        ================================================= -->
<!--                        <div class="post-content">
                            <h4>Info for Ausweis</h4>
                            <div class="post-container">
                                <img src="images/users/user-4.jpg" alt="user" class="profile-photo-md pull-left" />
                                <div class="post-detail">
                                    <div class="user-info">
                                        <h5><a href="timeline.html" class="profile-link">John Doe</a> <span class="following">following</span></h5>
                                        <p class="text-muted">Published a photo about 2 hour ago</p>
                                    </div>
                                    <div class="reaction">
                                        <a class="btn text-green"><i class="icon ion-thumbsup"></i> 39</a>
                                        <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 2</a>
                                    </div>
                                    <div class="line-divider"></div>
                                    <div class="post-text">
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt</p>
                                    </div>
                                    <div class="line-divider"></div>
                                    <div class="post-comment">
                                        <img src="images/users/user-13.jpg" alt="" class="profile-photo-sm" />
                                        <p><a href="timeline.html" class="profile-link">Brian </a>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. </p>
                                    </div>
                                    <div class="post-comment">
                                        <img src="images/users/user-8.jpg" alt="" class="profile-photo-sm" />
                                        <p><a href="timeline.html" class="profile-link">Richard</a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    </div>
                                    <div class="post-comment">
                                        <img src="images/users/user-1.jpg" alt="" class="profile-photo-sm" />
                                        <input type="text" class="form-control" placeholder="Post a comment">
                                    </div>
                                </div>
                            </div>
                        </div>-->
                    </div>

                </div>
            </div>
        </div>

        <!--======================Page Container STOP====================================-->
        <?php include 'footer.php' ?>
    </body>
</html>
