<?php
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);

session_start();
if(isset($_SESSION['username']))
{
  header('location: admin.php');
  exit();

}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login page</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php">
  	
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" required>
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password" required>
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  		
  	
  </form>
</body>
</html>