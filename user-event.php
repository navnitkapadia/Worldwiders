<!DOCTYPE php>
<php lang="en">
    <head>
        <meta http-equiv="content-type" content="text/php; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="" />
        <meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
        <meta name="robots" content="index, follow" />
        <title>User Event</title> 
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
                        <div class="post-content">
                            <!--<button type="button" class="btn btn-primary pull-right">Primary</button>-->
                            <div class="block-title">
                                <a href="" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myEvent">Add New</a>
                                <h3>Event</h3>
                            </div>
                            <div class="post-container">
                                <?php
                                $sql = "SELECT * FROM event";
                                $result = $mysqli->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    extract($row);
                                    ?>
                                    <figure>
                                        <a href="event-details.php?id=<?php echo $id; ?>"><img src="upload/<?php echo $file; ?>" width="300" height="150" alt="Baby Orang Utan hanging from a rope"></a>
                                        <label><?php echo $event; ?></label>
                                    </figure><br>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Post Content
                        ================================================= -->
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
                    </body>
                    </php>
