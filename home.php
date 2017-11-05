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
            function eventpost(event,j){
                var post = $('#eventdesc-' + j).val();
                if(post != '' || post != NULL){
                    $.ajax({
                    type: 'post',
                    url: "post.php?action=event-post",
                    data: "id=" + event + "&texts=" + post,
                    success: function (data) {
                        //clear the message box
                        $('#eventdesc-' + j).val("");
                        location.reload();
                    }
                });
                }
            }
            function post(gid, tid, i) {
                var comment = $('#desc-' + i).val();
                if(comment != '' || comment != NULL){
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
               }
            };
            function like(el,id,like){
                $.ajax({
                type: 'post',
                url: "post.php?action=like",
                data: "id=" + id + "&like=" + like,
                    success: function(data){
                       el.innerHTML = data;
                       $('#liketag').attr("disabled","disabled");
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
                        $('#disliketag').attr("disabled","disabled");
                    }
                });
            };
        </script>
    </head>
    <body> 
        <?php include 'header.php' ?>
        <!--======================Page Container START===================================-->
        
    <div class="container">
		<div class="row">
        	<div class="col-lg-3 col-md-3 col-sm-4">
            <?php include 'homemenu.php' ?>
     		</div>
     		<div class="col-lg-7 col-md-7 col-sm-5" id="page-content">
				  <div class="bs-docs-section clearfix">
					<div class="row">
					  <div class="col-lg-12">

                      <?php
                        $uid = $_SESSION['userid'];
                        $i = 1;
                        $login_id = $_SESSION['fbid'];
                        $sql = "SELECT pg.title,gt.topic,gt.description as tdesc, gt.id as gt_id, gt.created_at, gt.topic_like, gt.dislike, gt.group_id as gID, u.fb_id, u.name, pg.description from group_topic gt, peoples_group pg, group_member gm, users u where gt.group_id = pg.id and gm.group_id = gt.group_id and u.user_id = gt.user_id and gm.user_id = $uid order by gt.id desc";
                        $result = $mysqli->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            extract($row);
                        ?>



						<div class="news-box">
							<div class="header">
                            
									<div class="col-sm-1 col-md-2"><img src="<?php echo "http://graph.facebook.com/$fb_id/picture"; ?>" class="img-circle" /></div>
									<div class="col-sm-9 col-md-7">
										<p class="user"><a href="#"><?php echo $name; ?></a></p>
										<p class="time"><?php $msg = time_elapsed_string($created_at);
                                            echo "Published a post $msg "; ?></p>
									</div>

									<div class="col-sm-2 col-md-3 vote text-right">
                                    <?php 
                                            $liketopic= array();
                                            $likeuser= array();
                                            $likesuccess = array();
                                            $likeSql = "SELECT * FROM group_like";
                                            $likeresult = $mysqli->query($likeSql);
                                            while ($likerow = $likeresult->fetch_assoc()) {
                                                extract($likerow);
                                                $liketopic[] = $topic_id;
                                                $likeuser[] = $user_id;
                                                $likesuccess[] = $like_dislike;
                                            }

                                            if(in_array($_SESSION['userid'], $likeuser) && in_array($gt_id, $liketopic) && in_array(0, $likesuccess)){
                                                ?>
									<div class="col-sm-6">
                                        <i class="fa fa-thumbs-up icon" aria-hidden="true"></i> 
                                        <div style="display: inline;" id="likecounter<?php echo $gt_id; ?>">
                                                <?php echo $topic_like; ?>
                                        </div>
                                    </div>
                                            <?php } else { ?>

                                                <div class="col-sm-6" id="liketag"  onclick="like(likecounter<?php echo $gt_id; ?>,<?php echo $gt_id; ?>,<?php echo $topic_like; ?>)">
                                        <i class="fa fa-thumbs-up icon" aria-hidden="true"></i> 
                                        <div style="display: inline;" id="likecounter<?php echo $gt_id; ?>">
                                        <?php echo $topic_like; ?>
                                    </div>
                                    </div>
                                    <?php } ?>

                                    <?php 
                                        if(in_array($_SESSION['userid'], $likeuser) && in_array($gt_id, $liketopic) && in_array(1, $likesuccess)){ ?>
                                        
									<div class="col-sm-6">
                                        <i class="fa fa-thumbs-down icon negative" aria-hidden="true"></i>
                                        <div style="display: inline;" id="dislikecounter<?php echo $gt_id; ?>"><?php echo $dislike; ?> 
                                                </div>
                                    </div>

                                    <?php } else { ?>
                                        <div class="col-sm-6" id ="disliketag"  onclick="dislike(dislikecounter<?php echo $gt_id; ?>,<?php echo $gt_id; ?>,<?php echo $dislike; ?>)">
                                        <i class="fa fa-thumbs-down icon negative" aria-hidden="true"></i>
                                        <div style="display: inline;" id="dislikecounter<?php echo $gt_id; ?>"><?php echo $dislike; ?> 
                                            </div></a>
                                    </div>
                                    <?php } ?>

								</div>
							</div>
							<div class="content">
								<h3><?php echo $topic; ?><span>from the <?php echo $title; ?></span></h3>
								<p><?php echo $tdesc; ?></p>
                                <?php
                                        $select = "SELECT td.*,u.name,u.fb_id from topic_desc td,peoples_group pg,users u,group_topic gt where td.group_id=" . $row['gID'] . " and td.topic_id = gt.id and td.topic_id = " . $row['gt_id'] . " and pg.id=td.group_id and u.user_id=td.user_id order by td.id desc";
                                        $result1 = $mysqli->query($select);
                                        $post = 1;
                                        while ($row1 = $result1->fetch_assoc()) {
                                            extract($row1);
                                            ?>
								<div class="comments">
									<div class="col-sm-1 text-left">
										<img src="<?php echo "http://graph.facebook.com/$fb_id/picture"; ?>" class="img-circle" />
									</div>
									<div class="col-sm-11">
										<p class="user"><a href="#"><?php echo $name; ?></a></p>
										<p><?php echo $comment; ?></p>
									</div>
								</div>

                                <?php } ?>
                                <!--<?php if ($post == 1) { ?>
                                            <div class="post-comment">
                                                <img src="<?php echo "http://graph.facebook.com/$login_id/picture"; ?>" alt="" class="profile-photo-sm" />
                                                <input type="text" class="form-control" id="desc-<?php echo $i; ?>" placeholder="Post a comment">
                                                <input type="button" name="comment" id="comment-<?php echo $i; ?>" onclick="post(<?php echo $gID; ?>,<?php echo $gt_id; ?>,<?php echo $i; ?>);" class="btn btn-primary pull-right" value="Publish">
                                            </div>
                                            <?php $i++; ?>
                                        <?php } ?> -->
							</div>
						</div>


                        <?php } ?>






						</div>
					</div>
				</div>

				  <footer>
					<div class="row">
					  <div class="col-lg-12">

						<ul class="list-unstyled">
						  <li class="pull-right"><a href="#top">Back to top</a></li>
						  <li><a href="#">About</a></li>
						  <li><a href="#">Advertise</a></li>
						  <li><a href="#">Privacy Policy / Terms</a></li>
						  <li><a href="#">Support / Contact</a></li>
						</ul>
						<p>Based on <a href="http://getbootstrap.com" rel="nofollow">Bootstrap</a>. Icons from <a href="http://fortawesome.github.io/Font-Awesome/" rel="nofollow">Font Awesome</a>. Web fonts from <a href="http://www.google.com/webfonts" rel="nofollow">Google</a>.</p>

					  </div>
					</div>

				</footer>
    		</div>
    		<div class="col-lg-2 col-md-2 col-sm-3">
    			<?php include 'people-may.php' ?>
			</div>
		</div>
	</div>
        <!--======================Page Container STOP====================================-->
<?php include 'footer.php' ?>
    </body>
</html>
