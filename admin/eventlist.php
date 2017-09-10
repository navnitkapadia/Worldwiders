<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- tile chnage karvu -->
        <title>Friend Finder</title>



    </head>

    <body>

        <div id="wrapper">

            <?php include 'header.php' ?>
            <?php
            $query = "select * from event";
            //echo $query;
            $result = $mysqli->query($query);
            ?>
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Event</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- content aavse  chalu-->
                            <div class="panel panel-default">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Website</th>
                                                    <th>Location</th>
                                                    <th>Photo</th>
                                                    <th>Date</th>
                                                    <!-- <th>Nationality</th> -->
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row['id'] . "</td>";
                                                    echo "<td>" . $row['event'] . "</td>";
                                                    echo "<td>" . $row['website'] . "</td>";
                                                    echo "<td>" . $row['location_name'] . "</td>";
                                                    //echo "<td>".$row['location_address']."</td>";
                                                    echo "<td><img src='../upload/".$row['file']."'  alt='' height='50' width='50' /></td>";
                                                    echo "<td>" . $row['created_at'] . "</td>";
                                                    echo "</tr>";
                                                }
                                                ?>	
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
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
