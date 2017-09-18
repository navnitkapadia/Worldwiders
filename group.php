<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
            $(document).ready(function (e) {
                $('#file').change(function () {
                    var file_data = this.files[0];
                    var form_data = new FormData();
                    form_data.append('file', file_data);
                    $.ajax({
                        url: 'upload.php', // point to server-side PHP script 
                        dataType: 'text', // what to expect back from the PHP script
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function (response) {
                            $('#msg').html(response); // display success response from the PHP script
                        },
                        error: function (response) {
                            $('#msg').html(response); // display error response from the PHP script
                        }
                    });
                });
            });
        </script>		
<?php 
mysql_connect("localhost","root","");
mysql_select_db("demo");
if(isset($_POST['txt_submit']))
{
	$title=$_POST['txt_title'];
	$desc=$_POST['txt_desc'];
	$img=$_FILES["file"]["name"];
	$query="insert into groups values(NULL,'".$title."','".$desc."','".$img."')";
	echo $query;
	mysql_query($query);
}


?>
<p id="msg"></p>
<form novalidate="novalidate" method="post" enctype="multipart/form-data" action="" id="sky-form4" class="sky-form">
<input name="txt_title" id="txt_title"  placeholder="Enter Title" type="text">
<input name="txt_desc" id="txt_desc"  placeholder="Enter Description" type="text">
<input id="file" type="file" name="file">
<input type="submit" name="txt_submit" value="Submit" class="btn-u" />
</form>