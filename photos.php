<?php 

	// connect to database
	$con = mysql_connect('localhost','lspeters','602846') or die (mysql_error());
	$db = mysql_select_db('lspeters',$con);
	
	while($row = mysql_fetch_array($result)) {
		echo '<div id="img_div">';
			echo '<img src="images/' .$row['image']. '" >'
			// echo '<p>' .$row['text'].'</p>;
		echo '</div>';
	}
	
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
    
		<div class="span10 offset1">
			<div class="row">
				<h3>Pet Photos</h3>
			</div>
			
			
			   <div class="form-actions">
				  <a class="btn" href="home.php">Back</a>
			   </div>
			
			 
			</div>
		</div>
				
    </div> <!-- /container -->
  </body>
</html>