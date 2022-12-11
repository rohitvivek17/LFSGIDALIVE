<?php
require_once 'connection.php';
if(isset($_POST['user_id']))
{
   $user=$_POST['user_id'];
   $name=$_POST['user_name'];

 $sql="UPDATE students_record SET user_status =''  WHERE admno = '$user'";
                $conn->query($sql);
               
                    $msg= "Done Successfully";
                    
                    echo json_encode($msg);
                    mysqli_close($conn);
               
              
    
   
    
}
else
{
    $msg= "Error in logut";
                    echo json_encode($msg);
                     mysqli_close($conn);
                   
}

 

?>
