<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/php; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="" />
        <meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
        <meta name="robots" content="index, follow" />
        <title>Edit Profile</title>


    </head>
    <body>
        <?php 
        include 'header.php';
        if (isset($_POST['edit_profile'])) {
            $fname = $_POST["firstname"];
            $lname = $_POST["lastname"];
            $email = $_POST["Email"];
            $birth_date = $_POST["birth"];
            $gender = $_POST["optradio"];
            $city = $_POST["city"];
            $country = $_POST["country"];
            $nationality = $_POST["country"];
            $array = array($city, $country);
            $location = implode(",", $array);
            $about = $_POST["information"];
            $position = $_POST['position'];
            $sql = "update users set first_name='" . $fname . "',last_name='" . $lname . "',about='" . $about . "',birth_date='" . $birth_date . "',email='" . $email . "',nationality='" . $nationality . "',location='" . $location . "',position='".$position."' where user_id=" . $_SESSION['userid'];
            $result = $mysqli->query($sql);
            header('Location:edit-profile.php');
        }
        ?>  
        <!--======================Page Container START===================================-->

 <div class="container profile">
		<?php
		  $add = "";
		  $user = $_SESSION['userid'];
		  if(isset($_REQUEST['id'])){
			$see = $_REQUEST['id'];
			
			$sql = "SELECT * FROM users where user_id = $see";
		  }else {
			$sql = "SELECT * FROM users where user_id = $user";
		  }
		  $result = $mysqli->query($sql);
		  while($row = $result->fetch_assoc())
		  {
			extract($row);
			$pa = $cover.'&oe='.$oe;
		  ?>
			    
    	<div class="cover"  <?php if($cover !=""){ echo "style='background-image: url($pa)';";} ?>></div>
    
		<div class="row">
        	<div class="col-lg-3 col-md-3 col-sm-4">
			  <?php include 'homemenu.php' ?>
     		</div>
			 
     		<div class="col-lg-7 col-md-7 col-sm-5" id="page-content">
			 <form name="basic-info" method="post" id="basic-info" class="form-inline">
				  <div class="bs-docs-section clearfix">
				  	<div class="row your-header">
				  		<div class="col-sm-3">
				  			<img src=<?php echo  "http://graph.facebook.com/$fb_id/picture?type=large"; ?> alt="" class="img-fluid profile-photo">
						</div>
						<div class="col-sm-6">
							<h1><?php echo $name; ?></h1>
							<input type="text" id="position" name="position" placeholder="Enter your position"  value="<?php echo $position; ?>" />
							
							
						</div>
						<div class="col-sm-3">
						<?php 
						if(isset($see)){ 
                      $sql1 = "SELECT COUNT(*) as cn FROM friend_list WHERE user_id= $user and friend_id=$see";
                      $result1 = $mysqli->query($sql1);
                      while ($row = $result1->fetch_assoc()) {
                          extract($row);
                          if($cn==1){
                            echo "<a href='messages.php?id=<?php echo base64_encode($see);?>'><button class='btn btn-success'>Message</button></a>";
                          } else {
                            echo "<a href='api/insert.php?action=addfriend&friendid=$user_id'><button class='btn btn-success'>Add friend</button></a>";
                          }
                      }
                     }
						?>
						
							
							
						</div>
					</div>
					<div class="row infos">
					  <div class="col-lg-9">
						<h2><i class="fa fa-user-circle-o icon" aria-hidden="true"></i> Personal Information</h2>
						<p>
						
						 <textarea id="my-info" name="information" style="width: 500px;" class="form-control" placeholder="Some texts about me" rows="4" cols="150"><?php echo $about; ?></textarea></p>
					<button class="btn btn-success" name="edit_profile">Save Changes</button>
					  </div>
					  <div class="col-lg-3">
					  	<h2><i class="fa fa-heart-o icon" aria-hidden="true"></i> Interest</h2>
						<ul id="interests" class="interests list-inline">
						</ul>
						 <input id="newadd" type="hidden" class="form-control input-group-lg"  placeholder="Enter Language">
                       <input id="addint" class="formsu form-control input-group-lg"  placeholder="Enter Interests">
						<h2><i class="fa fa-flag icon" aria-hidden="true"></i> Languages</h2>
						 <ul id="lang">
						  </ul>
						   <input id="addlang" class="form-control input-group-lg"  placeholder="Enter Language">
					  </div>  
					</div>
				</div>
		  </form>
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
    			<div id="right-content" class="right-content">
					<div class="row">
						<div class="col-sm-12">
							<h2>Connection</h2>
							<?php 
                     if(isset($see)){
                       $sql = "SELECT count(*) as dost FROM friend_list where user_id = $see";
                     } else {
                      $sql = "SELECT count(*) as dost FROM friend_list where user_id = $user";
                     }
                        $result = $mysqli->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            extract($row);
                     ?> 
                      
					  <p><?php echo $dost; ?> people are connected </p>
                     <?php } ?>
						
							
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
							<div class="col-sm-12 text-center see-more">
								<a href="friend.php" class="btn btn-info">See more</a>
							</div>
							
							
						</div>
					</div>
   					<div class="row">
   						<div class="col-sm-12">
   							<div class="banner-example">A banner here</div>
   						</div>
   					</div>
    			</div>
			</div>
		</div>
		<?php } ?>
	</div>
        <!--======================Page Container STOP====================================-->
<?php include 'footer.php' ?>
<script>
$('.formsu').on('keypress', function (e) {
  if(e.which == 13) {
      var int = $('#newadd').val();
      var oldint = $('#oldinte').val();
      $.ajax({
            type: 'post',
            url: "api/update.php?action=add-int",
            data: {int:int,oldint:oldint},
            success: function(data){
                $("#interests").load("api/getdata.php?action=intrest");
                $("#addint").val("");
            }
        })
  }
});

$("#lang").load("api/getdata.php?action=lang");
$("#interests").load("api/getdata.php?action=intrest");

$('#addint').typeahead({
    source: function (query, result) {
        $.ajax({
            url: "api/getdata.php?action=selectint",
            data: 'q=' + query,            
            dataType: "json",
            type: "POST",
            success: function (data) {
                result($.map(data, function (item) {
                    $('#newadd').val(item.interest_id);
                    return item.interest_name;
                }));
            }
        });
    }
});

$('#addlang').on('keypress', function (e) {
  if(e.which == 13) {
      var lang = $('#addlang').val();
      var oldlang = $('#oldlang').val();
      $.ajax({
            type: 'post',
            url: "api/update.php?action=add-lang",
            data: {lang:lang,oldlang:oldlang},
            success: function(data){
                $("#lang").load("api/getdata.php?action=lang");
                $("#addlang").val("");
            }
        })
  }
});
</script>
    </body>
</html>
