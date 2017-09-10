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

            <?php
            include 'header.php';
            $query = "select * from users";
            //echo $query;
            $result11 = $mysqli->query($query);
            ?>
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="row">
                            <h1 class="page-header">User</h1>
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
                                                    <th>Email</th>
                                                    <th>Photo</th>
                                                    <th>Birth Date</th>
                                                    <!-- <th>Nationality</th> -->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($row11 = $result11->fetch_assoc()) {
                                                    extract($row11);
                                                    echo "<tr>";
                                                    echo "<td>$user_id</td>";
                                                    echo "<td>$first_name</td>";
                                                    echo "<td>$email</td>";
                                                    echo "<td> <img src='http://graph.facebook.com/" . $fb_id . "/picture?type=large' alt='' class='img-responsive profile-photo' style='width:60px; height:60px;' /></td>";
                                                    echo "<td>" . $birth_date . "</td>";
                                                    // echo "<td>".$row['nationality']."</td>";
                                                    echo "<td>";
                                                    if ($status == 0) {
                                                        echo "<a class='btn btn-success' href='updatestatus.php?user_id=" . $user_id . "&status=1'>Active</a>";
                                                    } else {
                                                        echo "<a class='btn btn-danger' href='updatestatus.php?user_id=" . $user_id . "&status=0'>Deactive</a>";
                                                    }
                                                    echo "</td>";
                                                    // echo "<td>".$row['user_id']."<td>";
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
