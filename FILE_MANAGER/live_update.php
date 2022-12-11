<?php


require_once 'conn.php';

if(ISSET($_POST['submit'])){
$Api_class=$_POST['Api_class'];
$Meeting_ID=$_POST['Meeting_ID'];
$Meeting_pass=$_POST['Meeting_pass'];
$db_id=$_POST['database_id'];


try{
    //setting attribute on the database handle
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Inserstion Query
    
    //UPDATE `live_credit` SET `class` = '5', `meeting_id` = 'vikasf', `meeting_pass` = '12' WHERE `live_credit`.`id` = 11;
    
    $sql="Update live_credit set meeting_id='$Meeting_ID' , meeting_pass='$Meeting_pass' , class='$Api_class' where id='$db_id'";
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