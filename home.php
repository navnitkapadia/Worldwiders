<?php
session_start();
if (!isset($_SESSION['fbid']) && !isset($_SESSION['userid'])) {
    header('Location: /');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/php; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="" />
        <meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
        <meta name="robots" content="index, follow" />
        <title>Home logged</title>
        <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {

            });
            function post(gid, tid, i) {
                var comment = $('#desc-' + i).val();
                $.ajax({
                    type: 'post',
                    url: "post.php?action=topic_desc",
                    data: {group: gid, topic: tid, comment: comment},
                    success: function (data) {
                        //clear the message box
                        $('#desc-' + i).val("");
                        location.reload();
                    }
                });
            };
            function like(el,id,like){
                $.ajax({
                type: 'post',
                url: "post.php?action=like",
                data: "id=" + id + "&like=" + like,
                    success: function(data){
                       el.innerHTML = data;         
                    }
                });
            };
            function dislike(el,id,dislike){
                $.ajax({
                type: 'post',
                url: "post.php?action=dislike",
                data: "id=" + id + "&dislike=" + dislike,
                    success: function(data){
                        el.innerHTML = data; 
                    }
                });
            };
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
                        <?php include 'homemenu.php' ?>
                    </div>
                    <div class="col-md-7">
                        <!-- Post Content
                        ================================================= -->
                        <?php
                        $uid = $_SESSION['userid'];
                        $i = 1;
                        $login_id = $_SESSION['fbid'];
                        $sql = "SELECT gt.topic,gt.description as tdesc, gt.id as gt_id, gt.created_at, gt.topic_like, gt.dislike, gt.group_id as gID, u.fb_id, u.name, pg.description from group_topic gt, peoples_group pg, group_member gm, users u where gt.group_id = pg.id and gm.group_id = gt.group_id and u.user_id = gt.user_id and gm.user_id = $uid";
                        $result = $mysqli->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            extract($row);
                            ?>
                            <div class="post-content">
                                <h3><?php echo $topic; ?></h3>
                                <div class="post-container">
                                    <img src="<?php echo "http://graph.facebook.com/$fb_id/picture"; ?>" alt="user" class="profile-photo-md pull-left" />
                                    <div class="post-detail">
                                        <div class="user-info">
                                            <h5><a class="profile-link"><?php echo $name; ?></a> <span class="following"></span></h5>
                                            <p class="text-muted"><?php $msg = time_elapsed_string($created_at);
                                            echo "Published a post $msg ";// echo date("Y-m-d", strtotime($created_at)); ?></p>
                                        </div>
                                        <div class="reaction">
                                            <a class="btn text-green"  onclick="like(likecounter<?php echo $gt_id; ?>,<?php echo $gt_id; ?>,<?php echo $topic_like; ?>)"><i class="icon ion-thumbsup"></i><div style="display: inline;" id="likecounter<?php echo $gt_id; ?>"><?php echo $topic_like; ?></div></a>
                                            <a class="btn text-red"  onclick="dislike(dislikecounter<?php echo $gt_id; ?>,<?php echo $gt_id; ?>,<?php echo $dislike; ?>)"><i class="fa fa-thumbs-down"></i><div style="display: inline;" id="dislikecounter<?php echo $gt_id; ?>"><?php echo $dislike; ?> </div></a>
                                        </div>
                                        <div class="line-divider"></div>
                                        <div class="post-text">
                                            <p><?php echo $tdesc; ?></p>
                                        </div>
                                        <?php
                                        $select = "SELECT td.*,u.name,u.fb_id from topic_desc td,peoples_group pg,users u,group_topic gt where td.group_id=" . $row['gID'] . " and td.topic_id = gt.id and td.topic_id = " . $row['gt_id'] . " and pg.id=td.group_id and u.user_id=td.user_id order by td.id asc";
                                        $result1 = $mysqli->query($select);
                                        $post = 1;
                                        while ($row1 = $result1->fetch_assoc()) {
                                            extract($row1);
                                            ?>
                                            <div class="line-divider"></div>
                                            <div class="post-comment">
                                                <img src="<?php echo "http://graph.facebook.com/$fb_id/picture"; ?>" alt="" class="profile-photo-sm" />
                                                <p><a class="profile-link"><?php echo $name; ?></a>&nbsp;<?php echo $comment; ?></p>
                                            </div>
                                        <?php } ?>
                                        <?php if ($post == 1) { ?>
                                            <div class="post-comment">
                                                <img src="<?php echo "http://graph.facebook.com/$login_id/picture"; ?>" alt="" class="profile-photo-sm" />
                                                <input type="text" class="form-control" id="desc-<?php echo $i; ?>" placeholder="Post a comment">
                                                <input type="button" name="comment" id="comment-<?php echo $i; ?>" onclick="post(<?php echo $group_id; ?>,<?php echo $gt_id; ?>,<?php echo $i; ?>);" class="btn btn-primary pull-right" value="Publish">
                                            </div>
                                            <?php $i++; ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- Newsfeed Common Side Bar Right
                    ================================================= -->
                    <div class="col-md-2 static">
                        <div class="suggestions" id="sticky-sidebar">
                            <h4 class="grey">People you may know...</h4>
                            <?php
                            $inlist = array();
                            $list = "SELECT friend_id as fb FROM friend_list where user_id = '" . $_SESSION['userid'] . "'";
                            $resultlist2 = $mysqli->query($list);
                            while ($row2 = $resultlist2->fetch_assoc()) {
                                extract($row2);
                                $inlist[] = $fb;
                            }
                            $userlis = "SELECT * FROM users where user_id != '" . $_SESSION['userid'] . "'";
                            $resultlist1 = $mysqli->query($userlis);
                            if (mysqli_num_rows($resultlist1) > 1) {
                                while ($row = $resultlist1->fetch_assoc()) {
                                    extract($row);
                                    if (!in_array($user_id, $inlist)) {
                                        ?>
                                        <div class="follow-user">
                                            <img src="<?php echo "http://graph.facebook.com/$fb_id/picture"; ?>" alt="" class="profile-photo-sm pull-left" />
                                            <div>
                                                <h5><a href="profile.php?id=<?php echo $user_id; ?>"><?php echo $name; ?></a></h5>
                                                <a href="api/insert.php?action=addfriend&friendid=<?php echo $user_id; ?>" class="text-green">Add friend</a>
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
        <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="myGroup" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="block-title">
                                <h4 class="grey"><i class="icon ion-android-checkmark-circle"></i> Add Group</h4>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <form name="basic-info" id="basic-info" class="form-inline" action="api/insert.php?action=make-group" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="title" class="pull-left">Group Title</label>
                                        <input id="title" class="form-control input-group-lg" type="text" name="title" title="Enter Title" placeholder="Event Name" value="" />
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
                                        <label for="file" class="pull-left">Group image</label>
                                        <input type="file" name="image" id="image" class="form-control"/>
                                    </div>
                                </div><br>
                                <button class="btn btn-primary text-center" name="add_group">Save</button><button type="button" class="btn btn-default text-center" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--======================Page Container STOP====================================-->
<?php include 'footer.php' ?>
    </body>
</html>
