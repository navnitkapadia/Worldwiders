<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Group List</title>

  </head>

<body>

    <div id="wrapper">
 
      <?php include 'header.php' ?>
	  <?php $query="select ps.id,u.first_name as fname,u.last_name as lname,ps.title as title,ps.file as file,ps.description as description,ps.admin_id as admin, ps.moderator_id as moderator from users u,peoples_group ps where ps.moderator_id = u.user_id";
			$result=$mysqli->query($query); 
			?>
	          <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Group List</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
				<div class="row">
                    <div class="col-lg-12">
                        		<div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                           
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Group image</th>
											<th>Admin</th>
											<th>Modrator</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									while($row=$result->fetch_assoc()) 
									{
										extract($row);
										$image = "../upload/$file";
										if($_SESSION['userid'] == $admin){
											$admin  =  "You";
										}
										echo "<tr>";
									  echo "<td>$title</td>";
									  echo "<td>$description</td>";
									  echo "<td><img style='width:100px; height:50px;' src='$image'></td>";
									  echo "<td>$admin</td>";
									  echo "<td>$fname $lname</td>";
									  echo "<td><a class='btn btn-primary' style='text-decoration:none;' href='creategroup.php?id=$id'><i class='glyphicon glyphicon-pencil'> </i> Edit</a>
									   <a href='groupdelete.php?id=$id' class='btn btn-danger'><i class='glyphicon glyphicon-remove'></i> Delete</a>
										</td>";
									  echo "<tr>";
									}  
									?>
                                    </tbody>
                                </table>
                  
                            </div>
                            <!--<a class="btn btn-danger glyphicon-remove"></a>-->
                             <!--<a href="groupdelete.php' class='btn btn-danger'><i class='glyphicon glyphicon-pencil'></i> </a>--> 
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
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

</body>

</html>
