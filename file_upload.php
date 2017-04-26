<form action='file_upload.php' enctype='multipart/form-data' method='post'></form>

<?php

//print_r($_FILES);

if($_FILES['file1']['size']>0 && $_FILES['file1']['size']<2000000){

	// create variables for $_FILES elements
	$filename = $_FILES['file1']['name'];
	$tempname = $_FILES['file1']['tmp_name'];
	$filesize = $_FILES['file1']['size'];
	$filetype = $_FILES['file1']['type'];
	
	// make sure slashes are correct
	$filetype = (get_magic_quotes_gpc() == 0
		? mysql_real_escape_string($filetype)
		: mysql_real_escape_string(stripslashes($_FILES['file1'])));
	
	// open the file that was uploaded 
	$fp = fopen($tempname, 'r');
	$content = fread($fp, filesize($tempname));
	$content = addslashes($content);
	
	// display the properties of the file that was uploaded
	echo 'filename: ' . $filename . '<br />';
	echo 'filesize: ' . $filesize . '<br />';
	echo 'filetype: ' . $filetype . '<br />';
	
	// close the file
	fclose($fp);
	
	if(!get_magic_quotes_gpc()) {
		$filename = addslashes($filename);
	}
	
	// connect to database
	$con = mysql_connect('localhost','lspeters','602846') or die (mysql_error());
	$db = mysql_select_db('lspeters',$con);
	
	// if connection was successful, insert the contents into the content (blob) field
	if($db) {
		$query = "INSERT INTO uploads (name, size, type, content) VALUES ('$filename', '$filesize', '$filetype', '$content')";
		mysql_query($query) or die('query failed');
		mysql_close();
		echo "upload successful";
	}
	// otherwise report error
	else echo "upload failed: " . mysql_error();
	
}

//show_source(__FILE__);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
	
	<div class="span10 offset">
		<div class="container">
			<br/><h3>Add a Pet Photo</h3>
		</div>
    		
	<div id="content">
		<form method="post" action="file_upload.php" enctype="multipart/form-data">
			<input type="hidden" name="size" value="1000000">
			<div>
				<input type="file" name="image">
			</div>
			<div>
				<input type="submit" name="upload" value="Upload Photo" class="btn">
			</div>
		</form>
	</div>
			
	<div class="form-actions">
		  <a class="btn" href="home.php">Back</a>
	</div>
					
	</div>
				
    </div> <!-- /container -->
  </body>
</html>