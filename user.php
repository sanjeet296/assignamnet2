<?php
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);

 session_start();
?>
<h1 align ="center"> Welcome <?php echo   $_SESSION['fname'].' '.$_SESSION['lname'];?> </h1>
<a href="logout.php">logout </a>