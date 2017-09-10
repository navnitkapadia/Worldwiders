<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Create Group</title>



    </head>

    <body>

        <div id="wrapper">

            <?php
            include_once 'header.php';
            $flag = 0;
            if (isset($_GET['id'])) {
                $id = $_REQUEST['id'];
                $sql = "SELECT * FROM peoples_group where id=$id";
                $result = $mysqli->query($sql);
                $row = $result->fetch_assoc();
                extract($row);
                $flag = 1;
            }
            ?>
            <script type="text/javascript" src="../js/typeahead.js"></script>
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Add/Edit group</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            if (isset($_POST['btnSubmit'])) {
                                if ($flag == 1) {
                                    // echo "Update";

                                    $userId = $_SESSION['userid'];
                                    $name = $_POST['title'];
                                    $desc = $_POST['description'];
                                    if ($_FILES['image']['name'] != "") {
                                        $image = rand(1000, 100000) . "_" . $_FILES['image']['name'];
                                    } else {
                                        $image = $file;
                                    }
                                    //$image = rand(1000,100000)."_".$_FILES['image']['name'];
                                    $moderator = $_POST['moderator'];
                                    $moderator_name = $_POST['moname'];

                                    $quey = "update peoples_group set title='$name',description='$desc',file='$image',moderator_id='$moderator',mo_name='$moderator_name' where id=$id";
                                    //echo $quey;
                                    $result = $mysqli->query($quey);
                                    if ($result) {
                                        echo "SuccesFully Update";
                                        //echo $_FILES['icon']['tmp_name'];
                                        if ($_FILES['image']['name'] != "") {
                                            $src = $_FILES['image']['tmp_name'];
                                            $upload_dir = "../upload";
                                            $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));
                                            $expensions = array("jpeg", "jpg", "png");

                                            if (in_array($file_ext, $expensions) === false) {
                                                echo "extension not allowed, please choose a JPEG or PNG file.";
                                            } else {
                                                move_uploaded_file($src, "$upload_dir/$image");
                                                if (file_exists("$upload_dir/$file")) {
                                                    unlink("$upload_dir/$file");
                                                }
                                            }
                                        }
                                    } else {
                                        echo "Fail Update, Please try agin.";
                                    }
                                } else {
                                    //echo "btn click";
                                    $userId = $_SESSION['userid'];
                                    $name = $_POST['title'];
                                    $desc = $_POST['description'];
                                    $image = rand(1000, 100000) . "_" . $_FILES['image']['name'];
                                    $moderator = $_POST['moderator'];
                                    $moderator_name = $_POST['moname'];

                                    //echo $name,$desc,$image,$moderator;
                                    $quey = "insert into peoples_group values(null,'$name','$desc','$image','$userId','$moderator','$moderator_name')";
                                    //echo $quey;
                                    $result = $mysqli->query($quey);
                                    if ($result) {
                                        echo "Update SuccesFully.";
                                        //echo $_FILES['icon']['tmp_name'];
                                        $src = $_FILES['image']['tmp_name'];
                                        $upload_dir = "../upload";
                                        $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));
                                        $expensions = array("jpeg", "jpg", "png");

                                        if (in_array($file_ext, $expensions) === false) {
                                            echo "extension not allowed, please choose a JPEG or PNG file.";
                                        } else {
                                            move_uploaded_file($src, "$upload_dir/$image");
                                        }
                                    } else {
                                        echo "Fail Submit, Please try agin.";
                                    }
                                }
                            }
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="title" class="pull-left">Group Title</label>
                                                    <input id="title" class="form-control input-group-lg" type="text" name="title" title="Enter Title" placeholder="Event Name" value="<?php if ($flag == 1) {
                                echo $title;
                            } ?>" />

                                                </div>
                                                <div class="form-group">
                                                    <label for="description" class="pull-left">Description</label>
                                                    <textarea id="description" name="description" class="form-control" placeholder="Description"><?php if ($flag == 1) {
                                echo $description;
                            } ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="file" class="pull-left">Group image</label>
                                                    <input type="file" name="image" id="image" class="form-control form-check-input"/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="title" class="pull-left">Modarator</label>
                                                    <input name="moderator" value="<?php echo $moderator_id; ?>"  id="moderator" type="hidden" />

                                                    <input name="id" value="<?php echo $id; ?>"  id="moderator" type="hidden" />

                                                    <input id="name-box" name="moname" value="<?php if ($flag == 1) {
                                echo $mo_name;
                            } ?>"  class="form-control typeahead input-group-lg" type="text"  title="Enter Title" placeholder="Add Modarator" />
                                                    <div id="suggesstion-box"></div>
                                                </div>
                                                <input type="submit" name="btnSubmit" class="btn btn-default" value="<?php if ($flag == 1) {
                                echo "Update Group";
                            } else {
                                echo "Submit Group";
                            } ?>" />
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
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
        <script>
            $(document).ready(function () {
                $('#name-box').typeahead({
                    source: function (query, result) {
                        $.ajax({
                            url: "../api/livesearch.php",
                            data: 'q=' + query,
                            dataType: "json",
                            type: "POST",
                            success: function (data) {
                                result($.map(data, function (item) {
                                    $('#moderator').val(item.user_id);
                                    return item.name;
                                }));
                            }
                        });
                    }
                });
            });
        </script>
    </script>
</body>

</html>
