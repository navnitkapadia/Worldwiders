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
                    <div class="col-md-3 static">
                        <?php include 'homemenu.php' ?>
                    </div> 

                    <div class="col-md-7">


                        <!-- Post Content
                        ================================================= -->
                        <div class="post-content">
                            <!--<button type="button" class="btn btn-primary pull-right">Primary</button>-->
                            <div class="block-title">
                                <h3>Group</h3>
                            </div>
                            <div class="post-container">
                                <?php
                                $userid = $_SESSION['userid'];
                                $sql = "SELECT pg.* FROM peoples_group pg,group_member gm where gm.group_id = pg.id and gm.user_id = $userid";
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
                    </div>
                    <!--======================Page Container STOP====================================-->
                    <?php include 'footer.php' ?>
                    </body>
                    </php>
