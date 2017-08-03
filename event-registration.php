
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
    <div class="form-wrapper">
        <!-- Register form -->
        <form>
            <p class="h5 text-center mb-4">Sign up</p>

            <div class="md-form">
                <i class="fa fa-user prefix grey-text"></i>
                <input type="text" id="orangeForm-name" class="form-control">
                <label for="orangeForm-name">Your name</label>
            </div>
            <div class="md-form">
                <i class="fa fa-envelope prefix grey-text"></i>
                <input type="text" id="orangeForm-email" class="form-control">
                <label for="orangeForm-email">Your email</label>
            </div>

            <div class="md-form">
                <i class="fa fa-lock prefix grey-text"></i>
                <input type="password" id="orangeForm-pass" class="form-control">
                <label for="orangeForm-pass">Your password</label>
            </div>

            <div class="text-center">
                <button class="btn btn-deep-orange">Sign up</button>
            </div>

        </form>
        <!-- Register form -->
    </div>
<?php include 'footer.php' ?>
<?php include 'scripts.php' ?>
</body>
</html>
