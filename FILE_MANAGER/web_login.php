<?php
 require_once 'connection.php';
$msg="";

if(isset($_POST['login']))
{
    $login_id=$_POST['login_id'];
    $password=$_POST['password'];
    $sql="select *from user_login where login_id='$login_id' and password='$password' ";
    $result=mysqli_query($conn,$sql);
   if(mysqli_num_rows($result)==1)
   {
      session_start();
       $_SESSION['login']='login_done';
       header("location:dashboard.php");
   }
   else
   {
      
      
       header("location:index.php");
       echo "<script> alert('Sorry Wrong user id and password');</script>";
   }
    
    
}




?>
