<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- tile chnage karvu -->
        <title>Dashboard</title>

    </head>

    <body>

        <div id="wrapper">

            <?php
            include 'header.php';
            if (isset($_REQUEST['uid'])) {
                $user_id = $_GET['uid'];
            } else {
                $user_id = 1;
            }
            $query = "select * from users where user_id = $user_id";
            //echo $query;
            $result = $mysqli->query($query);
            $row = $result->fetch_assoc();
            extract($row);
            ?>
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $name; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- content aavse  chalu-->

                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Profile Detail
                                    </div>
                                    <div class="panel-body" style="position: relative;">
                                        <img src="<?php echo $cover . '&oe=' . $oe; ?>" height="400" class="col-lg-12" />
                                        <img  style="position: absolute;
                                                    left: 30px;
                                                    bottom: 0;
                                                    top: 217px;
                                                    right: 0;"
                                        src=<?php echo  "http://graph.facebook.com/$fb_id/picture?type=large"; ?> alt="" class="profile-photo-sm"/>

                                        <div class="col-lg-12">
                                            <div class="panel panel-default">
                                                <div class="panel-body">



                                                    <div class="col-md-12">
                                                        <div class="col-xs-6 col-md-4"><h4>First Name</h4></div>
                                                        <div class="col-xs-6 col-md-8"><h4><small><?php echo $first_name; ?></small></h4></div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="col-xs-6 col-md-4"><h4>Last Name</h4></div>
                                                        <div class="col-xs-6 col-md-8"><h4><small><?php echo $last_name; ?></small></h4></div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="col-xs-6 col-md-4"><h4>Email</h4></div>
                                                        <div class="col-xs-6 col-md-8"><h4><small><?php echo $email; ?></small></h4></div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="col-xs-6 col-md-4"><h4>Date Of birth</h4></div>
                                                        <div class="col-xs-6 col-md-8"><h4><small><?php echo $birth_date; ?></small></h4></div>
                                                    </div>
                                                    
                                                    <div class="col-md-12">
                                                        <div class="col-xs-6 col-md-4"><h4>Language</h4></div>
                                                        <div class="col-xs-6 col-md-8"><h4><small><?php echo $languages; ?></small></h4></div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="col-xs-6 col-md-4"><h4>Nationality</h4></div>
                                                        <div class="col-xs-6 col-md-8"><h4><small><?php echo $nationality; ?></small></h4></div>
                                                    </div>
                                                    
                                                    <div class="col-md-12">
                                                        <div class="col-xs-6 col-md-4"><h4>Location</h4></div>
                                                        <div class="col-xs-6 col-md-8"><h4><small><?php echo $location; ?></small></h4></div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="col-xs-6 col-md-4"><h4>Last Active</h4></div>
                                                        <div class="col-xs-6 col-md-8"><h4><small><?php echo $lastactivity; ?></small></h4></div>
                                                    </div>

                                                </div>


                                            </div>
                                        </div>
                                        
<!--                                        <div class="col-md-4"><div class="panel-body">
                                        <img src="<?php echo $cover . '&oe=' . $oe; ?>" class="col-lg-12" />
                                            </div>  </div>-->
                                    </div>
                                    
                                </div>
                            </div>

                            <!--  aani vachhe development karvu -->
                            <!-- content aavse  puro -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <?php include 'footer.php' ?>

    </body>

</html>
