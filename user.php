<?php
include('error.php');

 session_start();
?>
<h1 align ="center"> Welcome <?php echo   $_SESSION['fname'].' '.$_SESSION['lname'];?> </h1>
<a href="logout.php">logout </a>