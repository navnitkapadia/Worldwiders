<!DOCTYPE php>
<php lang="en">
	<head>
    <meta http-equiv="content-type" content="text/php; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="" />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
		<meta name="robots" content="index, follow" />
		<title>Add Group</title>
	</head>
  <body>
    <?php include 'header.php'?>
    <!--======================Page Container START===================================-->
    <div class="container">
        <div id="page-contents">
            <div class="form-wrapper">
                <div class="block-title">
                  <h4 class="grey"><i class="icon ion-android-checkmark-circle"></i> Add Group</h4>
                  <div class="line"></div>
                </div>
                <form action="api/insert.php?action=make-group" method="POST" enctype="multipart/form-data">
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="title">Group Name</label>
                        <input name="title" id="title" class="form-control input-group-lg" type="text" title="Group Name" placeholder="Group Name" value="" />
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control" placeholder="Description"></textarea>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="image">group image</label>
                        <input type="file" id="image" class="form-control"/>
                      </div>
                    </div>
                    <button class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>

    <!--======================Page Container STOP====================================-->
    <?php include 'footer.php' ?>
  </body>
</php>
