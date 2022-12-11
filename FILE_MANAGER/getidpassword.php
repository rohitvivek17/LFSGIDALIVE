<?php
if(isset($_POST['class']))
{
require_once 'connection.php';
$cl=$_POST['class'];
$sql="select *from live_credit where class='$cl' ";
$response=mysqli_query($conn,$sql);
$result=mysqli_fetch_assoc($response);
$msg=array();
$msg['meeting_id']=$result['meeting_id'];
$msg['meeting_pass']=$result['meeting_pass'];

echo json_encode($msg);
mysqli_close($conn);
}
else
echo " wrong formate";

?>

