<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/php; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="" />
        <meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
        <meta name="robots" content="index, follow" />
        <title>Groups</title>


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
						<h3>Your groups</h3>
						<?php
							$join = true;
							$user = $_SESSION['userid'];
							$sql = "SELECT pg.* from peoples_group pg,group_member gm where pg.id=gm.group_id and gm.user_id=$user";
							$result = $mysqli->query($sql);
							while ($row = $result->fetch_assoc()) {
									extract($row);
              ?>
              	<div class="col-sm-4 group-box">
							  	<div class="col-sm-12 img-wrapper" style="background-image: url('<?php if ($file) {
                                        echo "upload/$file";
                                    } else {
                                        echo 'images/covers/5.jpg';
                                    } ?>')">
							  	</div>
							  	<div class="col-sm-12 group-info">
										<h4><a href="group-details.php?id=<?php echo $id; ?>"><?php echo $title; ?></a></h4>
										<p><i class="fa fa-people" aria-hidden="true"></i> 
										
										<?php
											$sql1 = "SELECT COUNT(*) as co FROM group_member WHERE group_id=$id";
											$result1 = $mysqli->query($sql1);
											while ($row1 = $result1->fetch_assoc()) {
												extract($row1);
												echo "$co";
											}
										?> group members</p>
							  	</div>
								</div>                      
							<?php } ?>

					




					</div>
					<div class="col-lg-12">
					<!--	<h3>Recommended Groups</h3>
					
					<?php
							$join = true;
							$user = $_SESSION['userid'];
							$sql = "SELECT pg.* from peoples_group pg,group_member gm where pg.id=gm.group_id and gm.user_id=$user";
							$result = $mysqli->query($sql);
							while ($row = $result->fetch_assoc()) {
									extract($row);
              ?>
              	<div class="col-sm-4 group-box">
							  	<div class="col-sm-12 img-wrapper" style="background-image: url('<?php if ($file) {
                                        echo "upload/$file";
                                    } else {
                                        echo 'images/covers/5.jpg';
                                    } ?>')">
							  	</div>
							  	<div class="col-sm-12 group-info">
										<h4><a href="group-details.php?id=<?php echo $id; ?>"><?php echo $title; ?></a></h4>
										<p><i class="fa fa-people" aria-hidden="true"></i> 
										
										<?php
											$sql1 = "SELECT COUNT(*) as co FROM group_member WHERE group_id=$id";
											$result1 = $mysqli->query($sql1);
											while ($row1 = $result1->fetch_assoc()) {
												extract($row1);
												echo "$co";
											}
										?> group members</p>
							  	</div>
								</div>                      
							<?php } ?> -->

				
						
						
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
