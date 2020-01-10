<?php
session_start();
if(isset($_SESSION['username']))
{
  header('location: admin.php');
  exit();

}


$db = mysqli_connect('localhost', 'phpmyadmin', 'java@123', 'admin');

if (isset($_POST['login_user']))
 {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
   
  
        $password = $password;
        
        $query = "SELECT * FROM admin_account WHERE username='$username' AND password='$password'";

        $results = mysqli_query($db, $query);
        

        if (mysqli_num_rows($results) == 1) 
        {
        echo "welcome";
        $_SESSION['username'] = $username;
        header('location: admin.php');
        }
        else {
            echo "user name incorrect";
        }
    
  }
  
  ?>