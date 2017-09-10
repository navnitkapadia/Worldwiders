<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
<!-- tile chnage karvu -->
    <title>Friend Finder</title>



</head>

<body>

    <div id="wrapper">
 
      <?php include 'header.php' ?>
     
	          <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add Interest</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
				<div class="row">
                    <div class="col-lg-12">
                        <!-- content aavse  chalu-->
                                                            <?php

if(isset($_POST['btnSubmit'])){
	$name=$_POST['name'];
	$icon=rand(1000,100000)."_".$_FILES['icon']['name'];
	
	//echo $name,$icon;
	$quey = "insert into interests values(null,'$name','$icon')";
	//echo $quey;
	$result = $mysqli->query($quey);
	if ($result){
	  echo "SuccesFully Submit";
	  //echo $_FILES['icon']['tmp_name'];
	  $src = $_FILES['icon']['tmp_name'];
	  $upload_dir = "../upload/interest_icon";
	  $file_ext=strtolower(end(explode('.',$_FILES['icon']['name'])));
	  $expensions= array("jpeg","jpg","png");
 
      if(in_array($file_ext,$expensions)=== false){
         echo "extension not allowed, please choose a JPEG or PNG file.";
      }else{
	     move_uploaded_file($src,"$upload_dir/$icon");
	  }
	  
	}else{
	  echo "Fail";	
	}
}

?>

                        <div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-6">
                                    
  

                                    
										<form method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="title" class="pull-left">Interst Name</label>                                            <input type="text" name="name" class="form-control input-group-lg" Placeholder="Interest Name" required />
                                        </div>
                                        
                                        <div class="form-group">
                                          <label for="file" class="pull-left">Interest Image</label>
                                            <input type="file" name="icon" id="image" class="form-control form-check-input" required />
                                        </div>
										
                                        <input type="submit" name="btnSubmit" class="btn btn-default" value="Submit Interest" />
                                    </form>
										
									</div>
								</div>
							</div>
						</div>
                        
                        
                      <!--   <form method="post" enctype="multipart/form-data">
          <div class="input-group py-2">
              <label class=" col-md-3">Enter Interest</label>
              <input type="text" name="name" Placeholder="Interest Name" />
          </div>
          <div class="input-group py-2">
              <label class=" col-md-3">Select Icon</label>
             <input type="file" name="icon" />
          </div>
          <div class="input-group col-5 py-2">
              <input type="submit" name="btnSubmit" value="Submit" />
          </div>
        </form> -->
        
            			 <!-- content aavse  puro -->
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
