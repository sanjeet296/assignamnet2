<?php
 $currentPage = $_GET['page'];
if(isset($_GET['msg'])){
  $Message = "poll created successfully";
  echo $Message;
}
?>
<?php
include('error.php');
include('db.php');
session_start();
if(!isset($_SESSION['username'])){
  header('location: login.php');
  exit();
}
?>
<?php
if ( isset($_GET['status'])){
  if($_GET['status']==0){
    $update ="UPDATE `polls` SET `Is_active`='1' WHERE id=". $_GET['edit_id'];
    $result = mysqli_query($db, $update);
    header('location: showpoll.php?page='.$currentPage);
    exit();
  }
  else{
    $update ="UPDATE `polls` SET `Is_active`='0' WHERE id=". $_GET['edit_id'];
    $result = mysqli_query($db, $update);
    header('location: showpoll.php?page='.$currentPage);
    exit();
  }
}
?>
<?Php
 if(isset($_GET['delete_id'])){
    $sql = "SELECT * FROM polls WHERE id =" .$_GET['delete_id'];
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
    $delete = "DELETE FROM polls WHERE id=". $_GET['delete_id']; 
    $run= mysqli_query($db,$delete);
      if($pages < $currentPage){
        header('location: showpoll.php?page='.$previousPage);
        exit();
      }else{
        header('location: showpoll.php?page='.$currentPage);
      }

  }
?>
<?php
if(isset($_GET['edit_id'])){
    $sql = "SELECT * FROM polls WHERE id =" .$_GET['edit_id'];
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
   }
   if(isset($_POST['btn-update'])){
    
      $question = $_POST['question'];
      $json = json_encode( $_POST['option']); 
      $date_edit=date("Y-m-d h:i:s");
      $update ="UPDATE `polls` SET `Question`='$question',`Options`='$json',`last edit`=' $date_edit' WHERE id=". $_GET['edit_id'];
      $up = mysqli_query($db, $update);
      header('location: showpoll.php?page='.$currentPage);
      exit();
      if(!isset($sql)){
            die ("Error $sql" .mysqli_connect_error());
      }
      else
      {
        echo"error mistake";
      }
   }
   ?>
  <!DOCTYPE html>
  <html>
    <head>
      <title>admin dashboard</title>
        <link rel="stylesheet" type="text/css" href="style.css">
  </head>

  <body>
  <a href="poll.php">Add New Poll</a>
  <div class="admin">
  <?php
  $showRecordPerPage = 5;
  if (isset($_GET['page']) && !empty($_GET['page'])) {
     $currentPage = $_GET['page'];
  }
  else{
   $currentPage = 1;
  }
  $startFrom = ($currentPage * $showRecordPerPage) - $showRecordPerPage;
  $query="select * from polls";
  $run = mysqli_query($db,$query);
  $totalpoll = mysqli_num_rows($run);
  $pages = $totalpoll;
  $lastPage = ceil($totalpoll/$showRecordPerPage);
  $firstPage = 1;
  $nextPage = $currentPage + 1;
  $previousPage = $currentPage - 1;
  $empSQL ="SELECT `id`, `Question`, `Options`, `Is_active`, `created time`, `last edit` FROM `polls` LIMIT $startFrom, $showRecordPerPage";
  $run = mysqli_query($db, $empSQL);
  $isEditMode = false;
  $isDeleteMode = false;
  if (isset($_GET['edit_id'])) {
    $isEditMode = $_GET['edit_id'];
    }
  if($run==true){
  ?>
  <table border="1">
    <tr bgcolor="pink">
      <td>Id</td>
      <td>question</td>
      <td colspan="4">option</td>
      <td>Edit</td>
      <td>Delete</td>
      <td>status</td>
      <td>created time</td>
      <td>lastedit time</td>
    </tr>
<?php
  while($data=mysqli_fetch_assoc($run)){ 
  $option= $data['Options'];
  $value=json_decode($option);
    if( $isEditMode != $data['id']){
?>
<form method="post">
<tr>
  <td>
      <?php echo $data['id']; ?>          
  </td>
  <td>
      <?php echo $data['Question']; ?>          
  </td>
  <?php foreach ($value as $val){ ?>
      <td>
        <?php echo $val; ?>
      </td>
  <?php } ?>
  <td><a href="showpoll.php?edit_id=<?php echo $data['id'];?>&page=<?php echo $currentPage ?>">edit</a></td>
  <td><a href="showpoll.php?delete_id=<?php echo $data['id'];?>&page=<?php echo $currentPage ?>">delete</a></td>
  <td>
    <a href="showpoll.php?edit_id=<?php echo $data['id'];?>&status=<?php echo $data['Is_active'];?>&page=<?php echo $currentPage ?>">
        <?php 
        if($data['Is_active']==0){
          echo 'activate';
        }
        else{
          echo 'deactivate';
        }
        ?>
    </a>
  </td>
  <td>
    <?php echo $data['created time']; ?>
        <br/>
        <br/>
  </td>
  <td>
    <?php echo $data['last edit']; ?>
        <br/>
        <br/>
  </td>
</tr>
</form>
<?php
    }
    else {
      ?>
<form method="post">
  <tr>
    <td>
        <?php echo $_GET['edit_id'] ?>
    </td>
    <td>
        <input type="text" name="question" value="<?php echo $data['Question']; ?>">
        <br/>
        <br/>
    </td>
    
       
        <?php foreach($value as $x => $val) {?>
    <td>
        <input type="text" name=option[]  value="<?php echo $val ?>">
            <br/><br/>
          
    </td> 
          <?php }?>
    <td>
        <button type="submit" name="btn-update"><strong>Update</strong></button>
    </td>
    <td>
        <button type="submit" name="btn_update"><strong>delete</strong></button>
    </td>
    <td></td>
    <td>
        <?php echo $data['created time']; ?>
            <br/>
            <br/>
    </td>
    <td>
        <?php echo $data['last edit']; ?><br/><br/>
    </td>
  </tr>
</form>
  <?php
    }
    }
    ?>

</table>
<nav aria-label="Page navigation">
  <?php
    if($pages>5){ ?>
      <ul style="list-style: none;" class="pagination">
        <?php
          if($currentPage != $firstPage) { ?>
        <li style="display: inline;" class="page-item">
          <a class="page-link" href="?page=<?php echo $firstPage ?>" tabindex="-1" aria-label="Previous">
              <span aria-hidden="true">First</span>
          </a>
        </li>
        <?php } ?>
        <?php if($currentPage >= 2) { ?>
        <li style="display: inline;" class="page-item">
            <a class="page-link" href="?page=<?php echo $previousPage ?>">
                <?php echo $previousPage ?>
            </a>
        </li>
        <?php } ?>
        <li style="display: inline;" class="page-item active">
            <a class="page-link" href="?page=<?php echo $currentPage ?>">
                <?php echo $currentPage ?>
            </a>
        </li>
        <?php if($currentPage != $lastPage) { ?>
        <li style="display: inline;" class="page-item">
            <a class="page-link" href="?page=<?php echo $nextPage ?>">
                <?php echo $nextPage ?>
            </a>
        </li>
        <li style="display: inline;" class="page-item">
            <a class="page-link" href="?page=<?php echo $lastPage ?>" aria-label="Next">
                <span aria-hidden="true">Last</span>
            </a>
        </li>
        <?php } ?>
      </ul>
        <?php } ?>
</nav>
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