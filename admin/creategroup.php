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
 
      <?php include_once 'header.php' ;
	  $flag=0;
	  if(isset($_REQUEST['id'])){
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
                        <h1 class="page-header">Create Group</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
				<div class="row">
                    <div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-6">
										<form role="form" action="../api/insert.php?action=make-group" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="title" class="pull-left">Group Title</label>
                                            <input id="title" class="form-control input-group-lg" type="text" name="title" title="Enter Title" placeholder="Event Name" value="<?php if($flag==1){echo $title;} ?>" />
                                       
                                        </div>
                                        <div class="form-group">
											<label for="description" class="pull-left">Description</label>
											<textarea id="description" name="description" class="form-control" placeholder="Description"><?php if($flag==1){echo $description; } ?></textarea>
                                        </div>
                                        <div class="form-group">
                                          <label for="file" class="pull-left">Group image</label>
                                            <input type="file" name="image" id="image" class="form-control form-check-input"/>
                                        </div>
										<div class="form-group">
                                            <label for="title" class="pull-left">Modarator</label>
											<input name="moderator" value="<?php echo $moderator_id; ?>"  id="moderator" type="hidden">
											<input name="id" value="<?php echo $id; ?>"  id="moderator" type="hidden">
                                            <input id="name-box" name="moname"  class="form-control  value="<?php if($flag==1){echo $mo_name;} ?>" typeahead input-group-lg" type="text"  title="Enter Title" placeholder="Add Modarator" value="" />
                                          <div id="suggesstion-box"></div>
                                        </div>
                                        <button type="submit" class="btn btn-default">Submit Button</button>
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
