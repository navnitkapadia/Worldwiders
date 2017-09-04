<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/php; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="" />
        <meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
        <meta name="robots" content="index, follow" />
        <title>Events</title>


    </head> 
    <body>
        <?php include 'header.php' ?>
        <!--======================Page Container START===================================-->

        <div id="page-contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 static">
                    <div id="datepicker" class="calendar"></div>
                    </div>
                    <div class="col-md-9">

                        <!-- Media
                        ================================================= -->
                        <div class="media">
                            <div class="row js-masonry" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": ".grid-sizer", "percentPosition": true }'>

                                <?php
                                $sql = "SELECT e.*,u.name,u.fb_id FROM event e,users u where e.created_by=u.user_id";
                                $result = $mysqli->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    extract($row);
                                    ?>
                                    <div class="grid-item col-md-4 col-sm-4">
                                        <div class="media-grid">
                                            <div class="img-wrapper">
                                                <img style="width:242px;" src=<?php if ($file) {
                                    echo "upload/$file";
                                } else {
                                    echo 'images/post-images/6.jpg';
                                } ?> alt="" class="img-responsive post-image" />
                                            </div>
                                            <div class="media-info">
                                                <div class="reaction">
                                                    <h4><a href="events-details.php"></a></h4>
                                                    <p><?php echo date('d.m.Y , l', strtotime($start_date)); ?>&nbsp; - Starting from: <?php echo $start_time; ?></p>
                                                </div>
                                                <div class="user-info">
                                                    <img src=<?php echo "http://graph.facebook.com/$fb_id/picture"; ?> alt="" class="profile-photo-sm pull-left" />
                                                    <div class="user">
                                                        <h6><a href="profile.php?id=" class="profile-link"><?php echo $name; ?></a></h6>
                                                        <a class="text-green" href="#">Friend</a>
                                                    </div>
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
        <!--======================Page Container STOP====================================-->
<?php include 'footer.php' ?>
<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script>
$(function() {
  $("#datepicker").datepicker('show');
});

$("#datepicker").datepicker({
  onSelect: function(dateText) {
    /* hear you can fire ajax for take data */
    $.ajax({
            type: 'post',
            url: "api/insert.php?action=eventslist",
            data: "date-select=" + dateText,
            dataType: 'json',
            success: function(data){
                alert('hi..');
                //clear the message box
                var r = JSON.parse(data);
                var x;
                for (x in r) {
                    //alert(r[x]['id']);
                }
                console.log(data);
            }
    });
  }
});
</script>
    </body>
</html>
