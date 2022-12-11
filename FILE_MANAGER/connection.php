<?php
$server="localhost";
$username="vivek123_root";
$password="wy_Yb1%WRA_B";
$database="vivek123_lfs";
$conn=new mysqli($server,$username,$password,$database);
if($conn->connect_error){
    die("Connectioned failed".$con->connect_error);


}
?>