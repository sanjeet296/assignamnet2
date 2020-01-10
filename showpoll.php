
<?php
session_start();
if(!isset($_SESSION['username']))
{
  header('location: admin.php');
  exit();

}
?>


<!DOCTYPE html>
<html>
<head>
  <title>admin dashboard</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  
</head>
<body>

    <div class="admin">
  <?php

$db = mysqli_connect('localhost', 'phpmyadmin', 'java@123', 'admin');



   $query="select * from polls";
 
   $run = mysqli_query($db,$query);

   if($run==true)
   {
      ?>
      <table border="1">
      <tr bgcolor="pink">
      <td>Id</td>
      <td>team</td>
      <td>player</td>
      
      </tr>
      <?php
      while($data=mysqli_fetch_assoc($run))
      {

       
         ?>
         <form method="post">
         <tr>
         <td><?php echo $data['id']; ?><br/><br/></td>
         <td><?php echo $data['team']; ?><br/><br/></td>
         <td><?php echo $data['player']; ?><br/><br/></td>
         >
        
         </tr>
         </form>
         <?php
       
        
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
  
 
  <h1><a href ="admin.php">back </a></h1>
</body>
</html>