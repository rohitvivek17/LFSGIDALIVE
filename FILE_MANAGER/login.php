<?php

if(isset($_POST['username']) && isset($_POST["Password"]))
{

  require_once 'connection.php';
$user=$_POST['username'];
$password=$_POST["Password"];

$sql="select *from users where user_id='$user' and user_password='$password' ";
$response=mysqli_query($conn,$sql);

if(mysqli_num_rows($response)==1)
{
    echo "success";
    mysqli_close($conn);

}
else
{
    echo "failed";
    mysqli_close($conn);
}

}
else
{
  require_once 'connection.php';
  $user='2603';
  $password='vikas';
  
  $sql="select *from users where user_id='$user' and user_password='$password' ";
  $response=mysqli_query($conn,$sql);
  
  if(mysqli_num_rows($response)==1)
  {
      echo "success";
      mysqli_close($conn);
  
  }
  else
  {
      echo "failed";
      mysqli_close($conn);
  }
  
}

?>
