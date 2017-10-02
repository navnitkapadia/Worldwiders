<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/php; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="" />
        <meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
        <meta name="robots" content="index, follow" />
        <title>Events</title>
        <style>
.event a {
    background-color: #5FBA7D !important;
    color: #ffffff !important;
}
</style> 

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
                        <div id="getevents" class="media">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--======================Page Container STOP====================================-->
<?php include 'footer.php' ?>
<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<div id="datepi"></div> 

<script>
$("#getevents").load("api/getEvents.php");
$("#datepi").load("api/GetEventsDates.php");
</script>
    </body>
</html>
