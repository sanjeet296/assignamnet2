<!DOCTYPE html>
<html>

<head>
    <title>Create polls</title>
</head>

<body>
    <h1> create poll </h1>
    <hr>
    <form method="post" action="poll.php">
        <div>
            <label>Question:</label>
            <textarea rows="4" cols="50" name="question"></textarea>
        </div>
        <h2>Options</h2>
        <div>
            <label>Option1:</label>
            <textarea rows="4" cols="30" name="option1"></textarea>
        </div>
        <div>
            <label>Option2:</label>
            <textarea rows="4" cols="30" name="option2"></textarea>
        </div>
        <div>
            <div>
                <label>Option3:</label>
                <textarea rows="4" cols="30" name="option3"></textarea>
            </div>
            <div>
                <label>Option4:</label>
                <textarea rows="4" cols="30" name="option4"></textarea>
                <div>
                    <button type="submit" class="btn" name="save">save</button>
                </div>
                <a href="admin.php">back </a>
    </form>
</body>

</html>
<?php
include('db.php');
if(isset($_POST['save'])){
  $question=$_POST['question'];
  $option1=$_POST['option1'];
  $option2=$_POST['option2'];
  $option3=$_POST['option3'];
  $option4=$_POST['option4'];
  $options=array( $option1, $option2, $option3, $option4);
  $json = json_encode($options); 
  $date=date("Y-m-d h:i:s");
  $sql="INSERT INTO `polls`(`Question`, `Options`,`created time`) VALUES ('$question','$json','$date')";
  mysqli_query($db,$sql);
  header("Location:showpoll.php?msg=true");
}
?>