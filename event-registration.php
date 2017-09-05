<?php 
	session_start();
	if(!isset($_SESSION['fbid']) && !isset($_SESSION['userid'])){
		 header('Location: /');
	}
?>
<!DOCTYPE php>
<php lang="en">
	<head>
    <meta http-equiv="content-type" content="text/php; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="" />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
		<meta name="robots" content="index, follow" />
		<title>Make Event</title>


	</head>
  <body>
    <?php include 'header.php'?>
	<script type="text/javascript">
            $(document).ready(function (e) {
                $('#file').change(function () {
                    var file_data = this.files[0];
                    var form_data = new FormData();
                    form_data.append('file', file_data);
                    $.ajax({
                        url: 'upload.php', // point to server-side PHP script 
                        dataType: 'text', // what to expect back from the PHP script
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function (response) {
                            $('#msg').html(response); // display success response from the PHP script
                        },
                        error: function (response) {
                            $('#msg').html(response); // display error response from the PHP script
                        }
                    });
                });
            });
        </script>
    <!--======================Page Container START===================================-->
    <div class="container">
        <div id="page-contents">
            <div class="form-wrapper">
                <div class="block-title">
                  <h4 class="grey"><i class="icon ion-android-checkmark-circle"></i> Add Event</h4>
                  <div class="line"></div>
                </div>
                <form name="basic-info" id="basic-info" class="form-inline" action="api/insert.php?action=new-event" method="POST" enctype="multipart/form-data">
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="title">Event Title</label>
                        <input id="title" class="form-control input-group-lg" type="text" name="event-name" title="Event Name" placeholder="Event Name" value="" />
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="date">Date</label>
                        <input id="date" class="form-control input-group-lg" type="date"  title="Date" placeholder="Add Date" value="" />
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="lname">Location Name</label>
                        <input id="lname" name="lname"  class="form-control input-group-lg" type="text" title="Location Name" placeholder="Location Name" value="" />
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="ladd">Location Address</label>
                        <input id="ladd" name="ladd"  class="form-control input-group-lg" type="text" title="Location Address" placeholder="Location Address" value="" />
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="Website">Website</label>
                        <input id="Website" class="form-control input-group-lg" type="text" name="Website" title="Website" placeholder="Website" value="" />
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="max-member">No of guests Allowed</label>
                        <input class="form-control input-group-lg" type="text" id="max-member" name="max-member" title="No of guests Allowed" placeholder="No of guests Allowed" value="" />
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control" placeholder="Description"></textarea>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="file">Event image</label>
                        <input type="file" name="file" id="file" class="form-control"/>
                      </div>
                    </div>
                    <button class="btn btn-primary">Save Changes</button>
                </form>
            </div> 
        </div>
    </div>
    <!--======================Page Container STOP====================================-->
    <?php include 'footer.php' ?>
  </body>
</php>
