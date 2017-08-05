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
        <form action="api/insert.php?action=make-group" method="POST" enctype="multipart/form-data">
            <p class="h5 text-center mb-4">Make Group</p>

            <div class="md-form">
                <input type="text" required name="title" id="title" class="form-control">
                <label for="title">Title</label>
            </div>
            <div class="md-form">
                <input type="text" required name="description" class="form-control">
                <label for="description">Description</label>
            </div>
            <div class="file-field">
                <div class="btn btn-primary btn-sm">
                    <span>Choose file</span>
                    <input name="image" type="file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" required type="text" placeholder="Upload group image">
                </div>
            </div>
            <div class="text-center">
                <button id="btn_grp" class="btn btn-deep-orange">Sign up</button>
            </div>

        </form>
        <!-- Register form -->
    </div>
    <?php include 'footer.php' ?>
</body>
<?php include 'scripts.php' ?>
<script>
    toastr.options = {
        "timeOut": "1000"
    }
    var url = new URL(window.location.href.toString());
    var msg = url.searchParams.get("msg");
    if (msg === "success") {
        self.toastr.success('Group Created');
    }
    if (msg === "failed") {
        self.toastr.error('Group Creation Failed');
    }
</script>

</html>