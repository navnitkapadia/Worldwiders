<!DOCTYPE html>
<html lang="en">
	<head>
    <meta http-equiv="content-type" content="text/php; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="" />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
		<meta name="robots" content="index, follow" />
		<title>Group</title>
        <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script type="text/javascript">
            function post(gid,tid,i){
                var comment = $('#desc-'+i).val();
                $.ajax({
                type: 'post',
                url: "post.php?action=topic_desc",
                data: {group:gid,topic:tid,comment:comment},
                    success: function(data){
                    //clear the message box
                    $('#desc-'+i).val("");
                    location.reload();
                    }
                });
            };
            function like(id,like){
                $.ajax({
                type: 'post',
                url: "post.php?action=like",
                data: "id=" + id + "&like=" + like,
                    success: function(data){
                       location.reload();
                    }
                });
            };
            function dislike(id,dislike){
                $.ajax({
                type: 'post',
                url: "post.php?action=dislike",
                data: "id=" + id + "&dislike=" + dislike,
                    success: function(data){
                        location.reload();
                    }
                });
            };
        </script>

	</head>
  <body> 
    <?php include 'header.php'?>
    <!--======================Page Container START===================================-->
	<div id="page-contents">
    	<div class="container">
    	<div class="timeline-cover">
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
			 <style> .timeline-cover{background-image: url("upload/<?php echo $file; ?>");}</style> 
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
                                        <?php } 
                                        $add = array();
                                        $sql = "SELECT user_id FROM group_member where group_id ='" . $group_Id . "'";
                                        $result = $mysqli->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                            extract($row);
                                            $add[] = $user_id;
                                        }
                                        if (in_array($_SESSION['userid'], $add)) {
                                            echo '<li><button class="btn-primary" data-toggle="modal" data-target="#mytopic">Add Posts</button></li>';
											echo '<li><button class="btn-primary" data-toggle="modal" data-target="#myEvent">New Event</button></li>';
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
            		<h4>Events</h4>
            		<div id="datepicker" class="calendar"></div>
            		<div class="suggestions" id="sticky-sidebar">
					  <h4>People in the group</h4>
					  
					  <?php
						$sql = "SELECT gm.id,gm.user_id as group_user,u.fb_id,u.name FROM group_member gm,users u where gm.user_id=u.user_id and gm.group_id='$group_Id'";
						$result = $mysqli->query($sql);
						while ($row = $result->fetch_assoc()) {
							extract($row);
                      ?>
					  
					  <div class="follow-user">
						<img src=<?php echo "http://graph.facebook.com/$fb_id/picture?type=large"; ?> alt="" class="profile-photo-sm pull-left" />
						<div>
						  <h5><a href="profile.php?id=<?php echo "$user_id"; ?>""><?php echo $name; ?></a></h5>
						   <?php
							$group = array();
							$select = "SELECT friend_id from friend_list where user_id = '".$_SESSION['userid']."'";
							$result5 = $mysqli->query($select);
							while($row5 = $result5->fetch_assoc()){
								extract($row5);
								$group[] = $friend_id;
							}
							if(in_array($group_user, $group)){
                           ?>
						    <a href="messages.php?friendid=<?php echo $group_user;?>" class="pull-left text-green">Message</a>
								<?php } elseif($_SESSION['userid'] == $group_user) { ?>
								
								<?php } else { ?>
								<a href="api/insert.php?action=addfriend&friendid=<?php echo $group_user;?>" class="pull-left text-green">Add friend</a>
								<?php } ?>
								<a  style="visibility:hidden;" href="#" class="text-green">ME</a>
						</div>
					  </div>
					  <?php } ?>
					  
					  
					  
					  
					</div>
         	 	</div>
    			<div class="col-md-9">
<!--- <div class="row">
                        <?php
                        $button = array();
                        $show = "SELECT user_id FROM group_member where group_id = $group_Id";
                        $result4 = $mysqli->query($show);
                            while ($row4 = $result4->fetch_assoc()) {
                                extract($row4);
                                $button[] = $user_id;
                            }
                            if(in_array($_SESSION['userid'], $button)){
                                echo '<h4><a href="" class="btn btn-primary pull-left col-md-3" data-toggle="modal" data-target="#mytopic">Add Post</a></h4>';
                            } else {
                                echo '<h4></h4>';
                            }
                        ?>
                        <h4><a href="" class="btn btn-primary pull-right col-md-3" data-toggle="modal" data-target="#myEvent">Add Event</a></h4>    
                        </div> -->

            <!-- Post Content
            ================================================= -->
				<div class="post-content <?php echo "open-$group_Id"; ?>">
                            <input type="hidden" id="group_id" value="<?php echo $group_Id; ?>">
                            <?php
                            $sql = "SELECT gt.topic, gt.created_at, gt.id, gt.group_id as gID, gt.topic_like, gt.dislike, u.fb_id, u.name, u.role_id, gt.description from group_topic gt, peoples_group pg, group_member gm, users u where gt.group_id = pg.id and gm.group_id = gt.group_id and gm.user_id = $user and u.user_id = gt.user_id and pg.id = $group_Id";
                            $result = $mysqli->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                extract($row);
                                echo "<h4>$topic</h4>";
                                if($role_id == 1 || $role_id == 0){
                                    echo "<h4><a href='topic-delete.php?id=$id&group_id=$gID' class='btn btn-danger pull-right'>Dalete</a></h4>";
                                }
                                ?>
                                <div class="post-container">
                                    <img src="<?php echo "http://graph.facebook.com/$fb_id/picture?type=large"; ?>" alt="user" class="profile-photo-md pull-left" />
                                    <div class="post-detail">
                                        <div class="user-info">
                                            <h5><a href="#" class="profile-link"><?php echo $name; ?></a> <span class="following"></span></h5>
                                            <p class="text-muted"><?php
                                            $date = date('y-m-d H:i:s'); 
                                            $d1 = date_create(date('Y-m-d H:i:s', strtotime($created_at)));
                                            $d2 = date_create($date); $diff = date_diff($d1, $d2);
                                            
                                            $day = $diff->format('%a');
                                            
                                            // echo $diff->format('%a')." ".date('Y-m-d', strtotime($created_at));
                                            //$date, date('Y-m-d', strtotime($created_at))
                                            $msg = time_elapsed_string($created_at);
                                            echo "Published a photo about $msg ";
                                            ?>
                                            
                                            
                                            </p>
                                        </div>2
                                        <div class="reaction likethis">
                                            <a class="btn text-green" onclick="like(<?php echo $id; ?>,<?php echo $topic_like; ?>)"><i class="icon ion-thumbsup"></i><?php echo $topic_like; ?></a>
                                            <a class="btn text-red" onclick="dislike(<?php echo $id; ?>,<?php echo $dislike; ?>)"><i class="fa fa-thumbs-down"></i><?php echo $dislike; ?></a>
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
                                                <img src="<?php echo "http://graph.facebook.com/$fb_id/picture?type=large"; ?>" alt="" class="profile-photo-sm" />
                                                <p><a href="#" class="profile-link"><?php echo $name; ?></a> <?php echo $comment; ?> </p>
                                            </div>
                                        <?php } ?>
                                        <?php if ($post == 1) { ?>
                                            <!--<form name="group" id="group" method="post">-->
                                                <div class="post-comment">
                                                    <img src="<?php echo "http://graph.facebook.com/$login_id/picture?type=large"; ?>" alt="" class="profile-photo-sm" />
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
		
        <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="mytopic" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="block-title">
                                <h4 class="grey"><i class="icon ion-android-checkmark-circle"></i> Add Topic</h4>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <form name="basic-info" id="basic-info" class="form-inline" action="post.php?id=<?php echo $group_Id; ?>" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="title" class="pull-left">Topic Name</label>
                                        <input id="topic-name" class="form-control input-group-lg" type="text" name="topic-name" title="Topic Name" placeholder="Topic Name" required="required" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="description" class="pull-left">Description</label>
                                        <textarea id="description" name="description" class="form-control" placeholder="Description" required="required"></textarea>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-primary text-center" name="add_topic">Save</button><button type="button" class="btn btn-primary text-center" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="myEvent" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="block-title">
                                <h4 class="grey"><i class="icon ion-android-checkmark-circle"></i> Add Event</h4>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <form name="basic-info" id="basic-info" class="form-inline" action="api/insert.php?action=new-event" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="title" class="pull-left">Event Title</label>
                                        <input id="event-name" class="form-control input-group-lg" type="text" name="event-name" title="Event Name" placeholder="Event Name" value="" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="date" class="pull-left">Date</label>
                                        <input id="event-date" class="form-control input-group-lg" type="date"  title="Date" placeholder="Add Date" name="event-date" value="" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="date" class="pull-left">Event Time</label>
                                        <input id="event-time" class="form-control input-group-lg" type="time"  title="Time" placeholder="Add Time" name="event-time" value="" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="lname" class="pull-left">Location Name</label>
                                        <input id="lname" name="lname"  class="form-control input-group-lg" type="text" title="Location Name" placeholder="Location Name" value="" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="ladd" class="pull-left">Location Address</label>
                                        <input id="ladd" name="ladd"  class="form-control input-group-lg" type="text" title="Location Address" placeholder="Location Address" value="" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="Website" class="pull-left">Website</label>
                                        <input id="website" class="form-control input-group-lg" type="text" name="website" title="Website" placeholder="Website" value="" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="max-member" class="pull-left">No of guests Allowed</label>
                                        <input class="form-control input-group-lg" type="text" id="max-member" name="max-member" title="No of guests Allowed" placeholder="No of guests Allowed" value="" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="description" class="pull-left">Description</label>
                                        <textarea id="description" name="description" class="form-control" placeholder="Description"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="file" class="pull-left">Event image</label>
                                        <input type="file" name="image" id="image" class="form-control"/>
                                    </div>
                                </div><br>
                                <button class="btn btn-primary text-center" name="add_event">Save</button><button type="button" class="btn btn-default text-center" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
		
    <!--======================Page Container STOP====================================-->
    <?php include 'footer.php' ?>
	<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script>
$(function() {
  $("#datepicker").datepicker('show');
});

$("#getevents").load("api/getEvents.php");
$("#datepicker").datepicker({
  onSelect: function(dateText) {
    $("#getevents").load("api/getEvents.php?date-select=" + dateText);
  }
});
</script>
  </body>
</html>
