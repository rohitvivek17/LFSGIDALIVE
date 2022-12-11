<?php
require_once 'connection.php';
$sql="select *from Live_Message order by msg_id DESC LIMIT 1";
$response=mysqli_query($conn,$sql);
$result=mysqli_fetch_assoc($response);
$msg=$result['msg_text'];
echo json_encode($msg);
mysqli_close($conn);
?>

