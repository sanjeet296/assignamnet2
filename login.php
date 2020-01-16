<?php
session_start();


if(isset($_SESSION['username']))
{
  header('location: admin.php');
  exit();

}


$db = mysqli_connect('localhost', 'root', 'java@123', 'sanjeet');

if (isset($_POST['login_user']))
 {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
   
  
        $password = $password;
        
        $query = "SELECT * FROM admin_account WHERE username='$username' AND password='$password'";

        $results = mysqli_query($db, $query);
        $res=mysqli_fetch_assoc($results);
        $_SESSION['fname']=$res['firstname'];
        $_SESSION['lname']= $res['lastname'];
        $_SESSION['isadmin']= $res['is_admin'];
        $_SESSION['isactive']= $res['Is_active'];
        $_SESSION['username']= $res['Username'];


        
        

        if (mysqli_num_rows($results) == 1) 
        {
            if($_SESSION['isactive']==0)
                {

              echo 'your account is disabled by admin';
              session_destroy();
              exit();

                 }
        else
          {

          
        
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

        else 
        {
            echo "username and passwords are incorrect";
            session_destroy();
        }
    
  }
  
  ?>