<?php
session_start();
if(!isset($_SESSION['username']))
{
  header('location: index.php');
  exit();
 

}
if($_SESSION['isadmin']==0)
{
  header('location: user.php');
  exit();
}


?>
 <?php
$db = mysqli_connect('localhost', 'root', 'java@123', 'sanjeet');
if ( isset($_GET['status'])){
  if($_GET['status']==0){
    $update ="UPDATE `admin_account` SET `Is_active`='1' WHERE id=". $_GET['edit_id'];
    $result = mysqli_query($db, $update);
    header('location: admin.php');

  }
  else{
    $update ="UPDATE `admin_account` SET `Is_active`='0' WHERE id=". $_GET['edit_id'];
    $result = mysqli_query($db, $update);
    header('location: admin.php');
  }
}

?> 

<?php
$db = mysqli_connect('localhost', 'root', 'java@123', 'sanjeet');
if(isset($_GET['edit_id'])){
    $sql = "SELECT * FROM admin_account WHERE id =" .$_GET['edit_id'];
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
   }
   if(isset($_POST['btn-update'])){
   

    
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $email = $_POST['email'];
    $occuption = $_POST['occuption'];
   
    $isadmin = $_POST['isadmin'];
    

   
    
    
   
    // $update = "UPDATE employee SET firstname=' $firstname',lastname=' $lastname',	age='$age',group=' $group' WHERE id=". $_GET['edit_id'];

    $update ="UPDATE `admin_account` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email',`occuption`='$occuption',`is_admin`='$isadmin' WHERE id=". $_GET['edit_id'];
    
    $up = mysqli_query($db, $update);
    header('location: admin.php');
    if(!isset($sql)){
    die ("Error $sql" .mysqli_connect_error());
    }
    else
    {
   echo"error mistake";
    }
   }
   ?>

   <?Php
  $db = mysqli_connect('localhost', 'root', 'java@123', 'sanjeet');
   if(isset($_GET['delete_id']))
      {
       $sql = "SELECT * FROM admin_account WHERE id =" .$_GET['delete_id'];
       $result = mysqli_query($db, $sql);
       $row = mysqli_fetch_array($result);
      // }
      // if(isset($_POST['btn_update'])){
        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $age = $_POST['email'];
        $group = $_POST['occuption'];
        $delete = "DELETE FROM admin_account WHERE id=". $_GET['delete_id']; 
        $run= mysqli_query($db,$delete);
      }
     
  ?>
<!DOCTYPE html>
<html>
<head>
  <title>admin dashboard</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  
</head>
<body>
 <h1><a style="float:right;" href="logout.php" >logout</a></h1>
 <h1><a href="poll.php" >polls</a></h1>

 Welcome <?php echo   $_SESSION['fname'].' '.$_SESSION['lname'];?>

 <h1 align ="center"> Admin dashboard</h1>
  
   <div class="admin">
  <?php

$db = mysqli_connect('localhost', 'root', 'java@123', 'sanjeet');


/* */
$isEditMode = false;
$isDeleteMode = false;
if( isset($_GET['edit_id']) ){
 $isEditMode = $_GET['edit_id'];
 
}


   $query="select * from admin_account";
 
   $run = mysqli_query($db,$query);

   if($run==true)
   {
      ?>
      <table border="1">
      <tr bgcolor="blue">
      <td>Id</td>
      <td>Firstname</td>
      <td>Lastname</td>
      <td>Email</td>
      <td>Occuption</td>
      <td>Isadmin</td>
      <td>Edit</td>
      <td>Delete</td>
      <td>status</td>
      
      
      
      </tr>
      <?php
      while($data=mysqli_fetch_assoc($run)){

        if( $isEditMode != $data['id']){

         ?>
         <form method="post">
         <tr>
         <td><?php echo $data['id']; ?><br/><br/></td>
         <td><?php echo $data['firstname']; ?><br/><br/></td>
         <td><?php echo $data['lastname']; ?><br/><br/></td>
         <td><?php echo $data['email']; ?><br/><br/></td>
         <td><?php echo $data['occuption']; ?><br/><br/></td>
         <td>
         <?php 
          if($data['is_admin']==0){
            echo 'user';
          }
          else{
            echo 'admin';
          }
            
        ?>
          </td>
         <td><a href="admin.php?edit_id=<?php echo $data['id'];?>">edit</a></td>
         <td><a href="admin.php?delete_id=<?php echo $data['id'];?>">delete</a></td>
        
         
         <td><a href="admin.php?edit_id=<?php echo $data['id'];?>&status=<?php echo $data['Is_active'];?>">
         <?php 
          if($data['Is_active']==0){
            echo 'activate';
          }
          else{
            echo 'deactivate';
          }
            
        ?>
        </a></td>
        
         </tr>
         </form>
         <?php
        } else {
          ?>


        <form method="post">
         <tr>
         <td><?php echo $_GET['edit_id'] ?></td>
         <td><input type="text" name="fname"  value="<?php echo $row['firstname']; ?>"><br/><br/></td>
         <td><input type="text" name="lname"  value="<?php echo $row['lastname']; ?>"><br/><br/></td>
         <td><input type="email" name="email"  value="<?php echo $row['email']; ?>"><br/><br/></td>
         <td><input type="text" name="occuption"  value="<?php echo $row['occuption']; ?>"><br/><br/></td>
         <td>
         <select name='isadmin'>
          <option value="1">admin</option>
          <option value="0">user</option>
          </select>
          </td>  
         
         <td>
         <button type="submit" name="btn-update" ><strong>Update</strong></button>
         </td>
         <td>
         <button type="submit" name="btn_update" ><strong>delete</strong></button>
          </td>
         
                            
          
         </tr>
         </form>

          <?php
        }
        
      }
      ?>
      
      </table>
      <?php
   }
   else{

         echo"error";


      }
   


?>
  </div>
  
  <h1><a href="showpoll.php">show poll result </a></h1>
  
  
</body>
</html>