<?php
session_start();
//connect to database

$db=mysqli_connect("localhost","lspeters","602846","lspeters");
if(isset($_POST['login_btn']))
{
    $username=mysqli_real_escape_string($db, $_POST['username']);
    $password=mysqli_real_escape_string($db, $_POST['password']);
    $password=md5($password); //We hashed password before storing last time
    $sql="SELECT * FROM customers WHERE username='$username' AND password='$password'";
		
    $result=mysqli_query($db,$sql);
    if(mysqli_num_rows($result)==1)
    {
		$response = $result->fetch_assoc();
        $_SESSION['message']="You are now Logged In";
		$_SESSION['userid']=$response['id'];
        header("location:home.php");
		exit();
    }
   else
   {
        $_SESSION['message']="Username and Password combination incorrect";
    }
}
else if (isset($_POST['register_btn']))
{
	header("location:register.php");
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
			<h3>Pet Directory Login</h3>
		</div>
				<form action="home.php" method="post">
				
					<div class="control-group">
						<label class="control-label">Username</label>
						<div class="controls">
							<input name="username" type="text" placeholder="Username" value="">
						</div>
					</div>
				  
					<div class="control-group">
						<label class="control-label">Password</label>
						<div class="controls">
							<input name="password_hash" type="password"  placeholder="Password" value="">
						</div>
					</div>
					<button type='submit' name='submit' class="btn">Login</button>   
	<br>

				</form>
		</div>
	</div>
	

	
	
	
	
		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	