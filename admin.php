<?php
session_start();
if(!isset($_SESSION['username']))
{
  header('location: index.php');
  exit();
 

}



?>

<?php
$db = mysqli_connect('localhost', 'phpmyadmin', 'java@123', 'admin');
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
    
    
   
    // $update = "UPDATE employee SET firstname=' $firstname',lastname=' $lastname',	age='$age',group=' $group' WHERE id=". $_GET['edit_id'];

    $update = "UPDATE `admin_account ` SET `firstname`= '$firstname',`	lastname`='$lastname',`	email`='$email',`occuption`='$occuption' WHERE id=". $_GET['edit_id'];
    $up = mysqli_query($db, $update);
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
  $db = mysqli_connect('localhost', 'phpmyadmin', 'java@123', 'admin');
   if(isset($_GET['edit_id']))
      {
       $sql = "SELECT * FROM admin_account WHERE id =" .$_GET['edit_id'];
       $result = mysqli_query($db, $sql);
       $row = mysqli_fetch_array($result);
      }
      if(isset($_POST['btn_update'])){
        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $age = $_POST['email'];
        $group = $_POST['occuption'];
        $delete = "DELETE FROM admin_account WHERE id=". $_GET['edit_id']; 
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
 <h1><a href="logout.php" >logout</a></h1>
 <h1><a href="poll.php" >polls</a></h1>

 <h1 align ="center"> Admin dashboard</h1>
  
   <div class="admin">
  <?php

$db = mysqli_connect('localhost', 'phpmyadmin', 'java@123', 'admin');


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
      <td>Edit</td>
      
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
         <td><a href="admin.php?edit_id=<?php echo $data['id'];?>">edit</a></td>
        
         </tr>
         </form>
         <?php
        } else {
          ?>


        <form method="post">
         <tr>
         <td><input type="text" name="id"  value="<?php echo $row['id']; ?>"><br/><br/></td>
         <td><input type="text" name="fname"  value="<?php echo $row['firstname']; ?>"><br/><br/></td>
         <td><input type="text" name="lname"  value="<?php echo $row['lastname']; ?>"><br/><br/></td>
         <td><input type="number" name="email"  value="<?php echo $row['email']; ?>"><br/><br/></td>
         <td><input type="text" name="occuption"  value="<?php echo $row['occuption']; ?>"><br/><br/></td>
        
         <td>
         <button type="submit" name="btn-update" ><strong>Update</strong></button>
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