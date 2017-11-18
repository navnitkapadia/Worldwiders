<div id="right-content" class="right-content">
					<div class="row">
						<div class="col-sm-12">
							<h2>People you may know...</h2>
                            <?php
                            $inlist = array();
                            $list = "SELECT friend_id as fb FROM friend_list where user_id = '" . $_SESSION['userid'] . "'";
                            $resultlist2 = $mysqli->query($list);
                            while ($row2 = $resultlist2->fetch_assoc()) {
                                extract($row2);
                                $inlist[] = $fb;
                            }
                            $userlis = "SELECT * FROM users where user_id != '" . $_SESSION['userid'] . "' ORDER BY RAND() LIMIT 5";
                            $resultlist1 = $mysqli->query($userlis);
                            if (mysqli_num_rows($resultlist1) > 1) {
                                while ($row = $resultlist1->fetch_assoc()) {
                                    extract($row);
                                    if (!in_array($user_id, $inlist)) {
                                        ?>
                            
							<div class="people-item">
								<div class="col-sm-3 image"><img src="<?php echo "http://graph.facebook.com/$fb_id/picture"; ?>" class="img-responsive img-circle" /></div>
								<div class="col-sm-9">
									<p class="user"><a href="profile.php?id=<?php echo $user_id; ?>"><?php echo $name; ?></a></p>
                                    <a href="api/insert.php?action=addfriend&friendid=<?php echo $user_id; ?>" class="btn btn-info">Add friend</a>
								</div>
							</div>


                            <?php
                                    }
                                }
                            }
                            ?>
						</div>
					</div>
   					<div class="row">
   						<div class="col-sm-12">
   							<!-- <div class="banner-example">A banner here</div> -->
   						</div>
   					</div>
    			</div>