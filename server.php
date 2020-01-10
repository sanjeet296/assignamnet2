<?php
session_start();
if(isset($_SESSION['username']))
{
  header('location: admin.php');
  exit();

}


$username = "";
$fname = "";
$lname = "";
$email = "";
$occuption = "";
$isactive = "";


 


$db = mysqli_connect('localhost', 'phpmyadmin', 'java@123', 'admin');


if (isset($_POST['reg_user'])) {
 
  $username = mysqli_real_escape_string($db, $_POST['username']);

  $fname = mysqli_real_escape_string($db, $_POST['fname']);

  $lname = mysqli_real_escape_string($db, $_POST['lname']);

  $email = mysqli_real_escape_string($db, $_POST['email']);

  $occuption = mysqli_real_escape_string($db, $_POST['occuption']);

  $isactive = mysqli_real_escape_string($db, $_POST['isactive']);

  $password_1 = mysqli_real_escape_string($db, $_POST['password']);

  $password = $password_1;


  $user_check_query = "SELECT * FROM admin_account WHERE Username='$username' OR 	email='$email' LIMIT 1";

  $result = mysqli_query($db, $user_check_query);

  $user = mysqli_fetch_assoc($result);

  
  
  if ($user['Username']== $username) 
  {
    echo "user exits";
    header('location: register.php');
    exit();  
   
    }

    else{

  
     $query = "INSERT INTO `admin_account`(`Username`, `firstname`, `lastname`, `email`, `occuption`, `Is_active`, `Password`) VALUES ('$username','$fname','$lname','$email','$occuption','$isactive','$password')";
      

  			  
    mysqli_query($db, $query);

    $_SESSION['username']= $username;
    
  	
      header('location: admin.php');
    }

}

?> 