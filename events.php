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
                            <div id="getevents" class="row js-masonry" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": ".grid-sizer", "percentPosition": true }'>

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

$("#getevents").load("api/getEvents.php");
$("#datepicker").datepicker({
  onSelect: function(dateText) {
    $("#getevents").load("api/getEvents.php?date-select=" + dateText);
  }
});
</script>
    </body>
</html>
