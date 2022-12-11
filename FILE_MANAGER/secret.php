<?php


require_once 'conn.php';

if(ISSET($_POST['submit'])){
$Api_class=$_POST['Api_class'];
$Meeting_ID=$_POST['Meeting_ID'];
$Meeting_pass=$_POST['Meeting_pass'];


try{
    //setting attribute on the database handle
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Inserstion Query
    $sql = "INSERT INTO `live_credit`(meeting_id, meeting_pass, class)  VALUES ('$Meeting_ID','$Meeting_pass', '$Api_class')";
    //Execute Query
    $conn->exec($sql);
}catch(PDOException $e){
    // Display error message
    echo $e->getMessage();
}
 //Closing the connection
$conn = null;
 //redirecting to the index page
header("location: dashboard.php");

}



?>