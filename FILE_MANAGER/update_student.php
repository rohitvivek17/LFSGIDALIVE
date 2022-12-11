<?php
require_once 'connection.php';
if(isset($_POST['save']))
{
   $admno=$_POST['admin_no'];
   $name=$_POST['firstname'];
   $cl=$_POST['class'];
   $sec=$_POST['sec'];
   $pass=$_POST['password'];
   $user_status=($_POST['user_status']=="NULL"?"":"Login");
   
   $sql="UPDATE `students_record` SET student_name = '$name', std='$cl' , password= '$pass', sec = '$sec', user_status='$user_status' WHERE `admno` = $admno;";
   $conn->query($sql);
   
       header("location: dashboard.php");
 
       
   
}