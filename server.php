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


$username = "";
$fname = "";
$lname = "";
$email = "";
$occuption = "";



 


$db = mysqli_connect('localhost','root','java@123','sanjeet');


if (isset($_POST['reg_user'])) {
 
  $username = mysqli_real_escape_string($db, $_POST['username']);

  $fname = mysqli_real_escape_string($db, $_POST['fname']);

  $lname = mysqli_real_escape_string($db, $_POST['lname']);

  $email = mysqli_real_escape_string($db, $_POST['email']);

  $occuption = mysqli_real_escape_string($db, $_POST['occuption']);

 

  $password_1 = mysqli_real_escape_string($db, $_POST['password']);

  $password = $password_1;


  $user_check_query = "SELECT * FROM admin_account WHERE Username='$username' OR 	email='$email' LIMIT 1";

  $result = mysqli_query($db, $user_check_query);

  $user = mysqli_fetch_assoc($result);

  
  
  if ($user['Username']== $username && $user['email']==$email) 
  {
    echo " username or email allready exits";
    session_destroy();
   
    exit();  
   
    }

    else{

  
     $query = "INSERT INTO `admin_account`(`Username`, `firstname`, `lastname`, `email`, `occuption`, `Password`) VALUES ('$username','$fname','$lname','$email','$occuption','$password')";

  			  
     $results= mysqli_query($db, $query);
     $res=mysqli_fetch_assoc($results);

    $_SESSION['username']= $username;
    $_SESSION['fname']= $fname;
    $_SESSION['lname']= $lname;
    $_SESSION['isadmin']= $res['is_admin'];

    if($_SESSION['isadmin']==1)
            {
                header('location: admin.php');
            } 
            else
            {

          header('location: user.php');
            }


  
   
   
    
  	
    
    }

}

?> 