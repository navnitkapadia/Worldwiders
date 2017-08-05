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
        <form action="api/insert.php?action=new-event" method="POST" enctype="multipart/form-data">
            <p class="h5 text-center mb-4">New Event</p>

            <div class="md-form">
                <input type="text" id="event" name="event-name" class="form-control">
                <label for="event">Title</label>
            </div>
            <div class="md-form">
                <input placeholder="Selected date" type="text" name="event-date" id="event-date" class="form-control datepicker">
                <label for="event-date">Date</label>
            </div>
            <div class="md-form">
                <input type="text" id="location-name" name="lname" class="form-control">
                <label for="location-name">Location Name</label>
            </div>
            <div class="md-form">
                <input type="text" id="location-address" name="ladd" class="form-control">
                <label for="location-address">Location address</label>
            </div>
            <div class="md-form">
                <input type="text" id="website" name="website" class="form-control">
                <label for="website">Website</label>
            </div>
            <div class="md-form">
                <input type="text" id="max-member" name="max-member" class="form-control">
                <label for="max-member">No of guests Allowed</label>
            </div>
            <div class="md-form">
                <textarea type="text" id="description" name="description" class="md-textarea"></textarea>
                <label for="description">Description</label>
            </div>
            </br>
            <div class="file-field">
                <div class="btn btn-primary btn-sm">
                    <span>Choose file</span>
                    <input name="image" type="file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" required type="text" placeholder="Cover image">
                </div>  
            </div>
            </br>
            </br>
            <div class="text-center">
                <button class="btn btn-deep-orange">Add new event</button>
            </div>

        </form>
        <!-- Register form -->
        </div>
        <?php include 'footer.php' ?>
        <?php include 'scripts.php' ?>
</body>
<script>
    toastr.options = {
        "timeOut": "1000"
    }
    var url = new URL(window.location.href.toString());
    var msg = url.searchParams.get("msg");
    if (msg === "success") {
        self.toastr.success('New event created');
    }
    if (msg === "failed") {
        self.toastr.error('New event creation Failed');
    }
    // Data Picker Initialization
    $('.datepicker').pickadate();
</script>

</html>