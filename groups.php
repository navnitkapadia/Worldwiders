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

            <!-- Timeline
            ================================================= -->
            <div class="timeline">
                <div id="page-contents">
                    <div class="row">
                        <div class="col-md-12"><h2>Groups</h2></div>
                        <div class="col-md-12">

                            <!-- Friend List
                            ================================================= -->
                            <div class="friend-list">
                                <div class="row">
                                    <?php
                                    $join = true;
                                    $sql = "SELECT * FROM peoples_group";
                                    $result = $mysqli->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        extract($row);
                                        ?>
                                        <div class="col-md-4 col-sm-4">
                                            <div class="friend-card">
                                                <img style="width:330px;height:138px;" src=<?php if ($file) {
                                        echo "upload/$file";
                                    } else {
                                        echo 'images/covers/5.jpg';
                                    } ?> alt="profile-cover" class="img-responsive cover" />
                                                <div class="card-info">
                                                    <div class="friend-info">
                                                        <?php
                                                        $add = array();
                                                        $sql2 = "SELECT user_id as uID FROM group_member where group_id =$id";
                                                        $result2 = $mysqli->query($sql2);
                                                        while ($row2 = $result2->fetch_assoc()) {
                                                            extract($row2);
                                                            $add[] = $uID;
                                                        }
                                                        if ($join) {
                                                            if (in_array($_SESSION['userid'], $add)) {
                                                                echo '<a href="#" class="pull-right text-green">Already joined</a>';
                                                            } else {
                                                                echo '<a href="update.php?gid=' . $id . '" class="pull-right text-red">Join</a>';
                                                            }
                                                        }
                                                        ?> 
                                                        <h5><a href="group-details.php?id=<?php echo $id; ?>" class="profile-link"><?php echo $title; ?></a></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
<?php } ?>
                                </div>
                            </div>
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
