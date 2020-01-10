<?php
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
  <title>Registration </title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="server.php">
 
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" placeholder="username">
  	</div>

	  <div class="input-group">
  	  <label>first name</label>
  	  <input type="text" name="fname" placeholder="firstname">
  	</div>

	  <div class="input-group">
  	  <label>last name</label>
  	  <input type="text" name="lname" placeholder="lastname">
  	</div>

	  <div class="input-group">
  	  <label>email id</label>
  	  <input type="text" name="email" placeholder="email_id">
  	</div>
	  <div class="input-group">
  	  <label>occuption</label>
  	  <input type="text" name="occuption" placeholder="occuption">
  	</div>

	  <div class="input-group">
  	  <label>is active</label>
  	  <input type="number" name="isactive" placeholder="">
  	</div>
  	
  	
  	
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password" placeholder="password">
  	</div>

  	
  	
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="index.php">Sign in</a>
  	</p>
  </form>
</body>
</html>
