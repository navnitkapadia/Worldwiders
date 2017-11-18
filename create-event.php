<!DOCTYPE html>
<html lang="en">
	<head>
    <meta http-equiv="content-type" content="text/php; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="" />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
		<meta name="robots" content="index, follow" />
		<title>Home logged</title>
	<?php $group_Id = $_REQUEST['id']?>

	</head>
  <body> 
    <?php include 'header.php'?>
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
					  	<div class="calendar">
					  		<h3>Add a new event</h3>
					  		
					  	</div>
					  
                       
                        	<form name="basic-info" id="basic-info" class="form-inline add-event" action="api/insert.php?action=new-event&gid=<?php echo $group_Id; ?>" method="POST" enctype="multipart/form-data">
			<div class="row">
			<div class="form-group col-xs-12">
				<label for="event-name" class="pull-left">Title</label>
				<input id="event-name" class="form-control input-group-lg" type="text" name="event-name" title="Event Name" placeholder="Event Name" value="" required="required"/>
			</div>
           </div>
			<div class="row">
			<div class="form-group col-xs-12">
				<label for="event-date" class="pull-left">Date</label>
				<input id="event-date" class="form-control input-group-lg" type="date"  title="Date" placeholder="Add Date" name="event-date" value="" required="required"/>
			</div>
				</div>
		<div class="row">
			<div class="form-group col-xs-12">
				<label for="date" class="pull-left">Time</label>
				<input id="event-time" class="form-control input-group-lg" type="time"  title="Time" placeholder="Add Time" name="event-time" value="" required="required"/>
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
				<input id="ladd" name="ladd"  class="form-control input-group-lg" type="text" title="Location Address" placeholder="Location Address" value="" required="required"/>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-xs-12">
				<label for="entrace-fee" class="pull-left">Entrance fee</label>
				<input id="entrace-fee" class="form-control input-group-lg" type="number" name="entrace-fee" title="Entrance fee" placeholder="Entrance fee" value="" required="required"/>
			</div>
         </div>
		<div class="row">
			<div class="form-group col-xs-12">
				<label for="Website" class="pull-left">Website</label>
				<input id="website" class="form-control input-group-lg" type="text" name="website" title="Website" placeholder="Website" value=""/>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-xs-12">
				<label for="max-member" class="pull-left">No of guests Allowed</label>
				<input class="form-control input-group-lg" type="number" id="max-member" name="max-member" title="No of guests Allowed" placeholder="No of guests Allowed" value="" required="required"/>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-xs-12">
				<label for="description" class="pull-left">Description</label>
				<textarea id="description" name="description" class="form-control" placeholder="Description" required="required"></textarea>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-xs-12">
				<label for="file" class="pull-left">Cover image</label>
				<input type="file" name="image" id="image" class="form-control" required="required"/>
			</div>
		</div><br>
		<button class="btn btn-primary text-center" name="add_event">Create event</button>
    </form>
 
 
						
                        

					  </div>
					</div>
				  </div>
					
				
				<?php include 'content-footer.php' ?>
				  
    		</div>
    		<div class="col-lg-2 col-md-2 col-sm-3">
    			<div id="right-content" class="right-content">
					<div class="row">
						<div class="col-sm-12">
							<h2>People you may know...</h2>
							<div class="people-item">
								<div class="col-sm-3 image"><img src="http://graph.facebook.com/1364909596950234/picture" class="img-responsive img-circle" /></div>
								<div class="col-sm-9">
									<p class="user"><a href="#">Luiis Franceschi</a></p>
									<p><a href="#" class="btn btn-info">Add friend</a></p>
								</div>
							</div>
							<div class="people-item">
								<div class="col-sm-3 image"><img src="http://graph.facebook.com/1364909596950234/picture" class="img-responsive img-circle" /></div>
								<div class="col-sm-9">
									<p class="user"><a href="#">Luiis Franceschi</a></p>
									<p><a href="#" class="btn btn-info">Add friend</a></p>
								</div>
							</div>
							<div class="people-item">
								<div class="col-sm-3 image"><img src="http://graph.facebook.com/1364909596950234/picture" class="img-responsive img-circle" /></div>
								<div class="col-sm-9">
									<p class="user"><a href="#">Luiis Franceschi</a></p>
									<p><a href="#" class="btn btn-info">Add friend</a></p>
								</div>
							</div>
							<div class="people-item">
								<div class="col-sm-3 image"><img src="http://graph.facebook.com/1364909596950234/picture" class="img-responsive img-circle" /></div>
								<div class="col-sm-9">
									<p class="user"><a href="#">Luiis Franceschi</a></p>
									<p><a href="#" class="btn btn-info">Add friend</a></p>
								</div>
							</div>
							<div class="people-item">
								<div class="col-sm-3 image"><img src="http://graph.facebook.com/1364909596950234/picture" class="img-responsive img-circle" /></div>
								<div class="col-sm-9">
									<p class="user"><a href="#">Luiis Franceschi</a></p>
									<p><a href="#" class="btn btn-info">Add friend</a></p>
								</div>
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
	</div>

    <!--======================Page Container STOP====================================-->
    <?php include 'footer.php' ?>
  </body>
</html>
