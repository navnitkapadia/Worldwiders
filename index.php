<?php  
  session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Demo page template</title>
    <?php include 'styles.php' ?>
</head>

<body>
<?php include 'header.php' ?>
    <!-- copy this file code and paste it in new file -->
    <!-- Start your project here-->
    <div style="height: 100vh">
        <div class="flex-center flex-column">
            <h1 class="animated fadeIn mb-4">Welcome to WorldWiders</h1>
            <h1 class="animated fadeIn mb-4"><?php echo $_SESSION['name']; ?></h1>
            <h1 class="animated fadeIn mb-4"><?php echo $_SESSION['email']; ?></h1>
        </div>
    </div>
    <!-- /Start your project here-->
<?php include 'footer.php' ?>
</body>
<?php include 'scripts.php' ?>
</html>
