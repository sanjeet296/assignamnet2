

<!DOCTYPE html>
<html>
<head>
  <title>user poll</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>poll</h2>
  </div>
	 
  <form method="post" action="">
  	
  	<div class="input-group">

  		<label>1.whicH team you support in IPL??</label>

	<select name ="team">

  <option value="CSK">CSK</option>
  <option value="MI">MI</option>
  <option value="KKR">KKR  </option>
  <option value="SRH">SRH</option>
  <option value="DC">SRH</option>
  <option value="RR">SRH</option>
  
</select>

  	</div>

  	<div class="input-group">
  		<label>2.who is your favourite player?</label>
  		<select name ="player">
  <option value="DHONI">DHONI</option>
  <option value="SACHIN">SACHIN</option>
  <option value="VIRAT">VIRAT  </option>
 
</select>
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="poll_user">submit</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  		
  	
  </form>
</body>
</html>
<?php

$db = mysqli_connect('localhost', 'root', 'java@123', 'sanjeet');


if (isset($_POST['poll_user']))
{
$team= mysqli_real_escape_string($db, $_POST['team']);
$player= mysqli_real_escape_string($db, $_POST['player']);
$sql="INSERT INTO `polls`( `team`, `player`) VALUES ('$team','$player')";

mysqli_query($db, $sql);
header('location: admin.php');


}


?>
