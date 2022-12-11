<?php 

    require_once("conn.php");

    if(isset($_POST['update']))
    {
      

        $admin_no = $_POST['admin_no'];
		$firstname = $_POST['firstname'];
		$class = $_POST['class'];
		$sec = $_POST['sec'];
		$password = $_POST['password'];

       
       
        $query = " update records set firstname = '".$firstname."', class='".$class."',sec='".$sec."',, password='".$password."' where admin_no='".$admin_no."'";

       
       
       
        $result = mysqli_query($con,$query);

        if($result)
        {
            header("location:view.php");
        }
        else
        {
            echo ' Please Check Your Query ';
        }
    }
    else
    {
        header("location:view.php");
    }


?>