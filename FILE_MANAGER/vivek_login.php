
<?php

    if(isset($_POST['username']) and isset($_POST["Password"]))
    {
        require_once 'connection.php';
        $user=$_POST['username'];
        $password=$_POST["Password"];

        $sql="select *from students_record where admno='$user' and password='$password' ";
        $response=mysqli_query($conn,$sql);

        $result=array();
        $result['login']=array();
        if(mysqli_num_rows($response)==1)
        {
            while($row=mysqli_fetch_assoc($response))
            {
                
            if($row['user_status']==null)
            {
                $index['user_id']=$row['admno'];
                $index['user_name']=$row['student_name'];
                $index['user_class']=$row['std'];
                $index['user_sec']=$row['sec'];
                $sql="UPDATE students_record SET user_status = 'Login' WHERE admno = '$user'";
                $conn->query($sql);

               

                array_push($result['login'],$index);
                $result['success']="1";
                $result['message']="success";
                echo json_encode($result);
                 mysqli_close($conn);
            }
            else
            {
                 $result['success']="1";
                $result['message']="Login";
                echo json_encode($result);
                 mysqli_close($conn);
            }
            






            }
        }
        else
        {
            $result['success']="0";
            $result['message']="error";
            echo json_encode($result);
             mysqli_close($conn);

        }
    
    }
    else
    {
        echo "only Admin can access";
    }
?>
