<?php
if(isset($_POST['delete']))
{
    try {
        $pdoConnect = new PDO("mysql:host=localhost;dbname=db_pdo_search","root","");
    } catch (PDOException $exc) {
        echo $exc->getMessage();
        exit();
    }
    
     // get id to delete

    $admin_no = $_POST['admin_no'];
    
     // mysql delete query 

    $pdoQuery = "DELETE FROM `member` WHERE `admin_no` = :admin_no";
    
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    
    $pdoExec = $pdoResult->execute(array(":admin_no"=>$admin_no));
    
    if($pdoExec)
    {
        echo 'Data Deleted';
    }else{
        echo 'ERROR Data Not Deleted';
    }

}

?>