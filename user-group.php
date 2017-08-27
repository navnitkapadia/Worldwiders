<!DOCTYPE php>
<php lang="en">
    <head>
        <meta http-equiv="content-type" content="text/php; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="" />
        <meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
        <meta name="robots" content="index, follow" />
        <title>User Group</title> 
    </head>
    <body>
        <?php include 'header.php' ?>
        <!--======================Page Container START===================================-->

        <div id="page-contents">
            <div class="container">
                <div class="row">

                    <!-- Newsfeed Common Side Bar Left
                    ================================================= -->
                    <?php include 'homemenu.php'; ?>
                    <div class="col-md-7">


                        <!-- Post Content
                        ================================================= -->
                        <div class="post-content">
                            <!--<button type="button" class="btn btn-primary pull-right">Primary</button>-->
                            <div class="block-title">
                                <a href="" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myGroup">Add New</a>
                                <h3>Group</h3>
                            </div>
                            <div class="post-container">
                                <?php
                                $sql = "SELECT * FROM peoples_group where user_id='".$_SESSION['fbid']."'";
                                $result = $mysqli->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    extract($row);
                                    ?>
                                    <figure>
                                        <a href="group-details.php?id=<?php echo $id; ?>"><img src="upload/<?php echo $file; ?>" width="300" height="150" alt="Baby Orang Utan hanging from a rope"></a>
                                        <label><?php echo $title; ?></label>
                                    </figure><br>
                                <?php } ?>
                                </div>
                            </div>

                            <!-- Post Content
                            ================================================= -->
                            <div class="post-content">
                                <h3>Join Group</h3>
                                <div class="post-container">
                                <?php
                                $sql = "SELECT ps.* FROM peoples_group ps where ps.user_id !='".$_SESSION['fbid']."'";
                                $result = $mysqli->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    extract($row);
                                    ?>
                                    <figure>
                                        <a href="group-details.php?id=<?php echo $id; ?>"><img src="upload/<?php echo $file; ?>" width="300" height="150" alt="Baby Orang Utan hanging from a rope"></a>
                                        <label><?php echo $title; ?></label>
                                    </figure><br>
                                <?php } ?>
                        <!-- Newsfeed Common Side Bar Right
                        ================================================= -->
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
                                            <label for="topic" class="pull-left">Topic</label>
                                            <textarea id="topic" name="topic" class="form-control" placeholder="Enter Topic"></textarea>
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
</php>
