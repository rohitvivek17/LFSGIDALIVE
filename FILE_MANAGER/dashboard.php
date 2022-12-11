<?php
require_once 'db.php';
session_start();
if(!(isset($_SESSION['login'])))
{
    header("location:index.php");
    
}

$bt="save";
$dt="add";
$bt_m="";
if(isset($_GET['delete']))
{
	$data=$_GET['delete'];
	
	$sql="Delete from students_record where admno='$data'";
	mysqli_query($conn,$sql);
	

}

if(isset($_GET['edit']))
{
	$bt="Update";
	$dt="edit";
	$data=$_GET['edit'];
	$sql="Select *from students_record where admno='$data'";
	$res=mysqli_query($conn,$sql);
	$resp=mysqli_fetch_assoc($res);
}
if(isset($_GET['edit_credit']))
{
    $bt_m="update";
    $data=$_GET['edit_credit'];
    $sql="Select *from live_credit where id='$data'";
   $res=mysqli_query($conn,$sql);
	$resp=mysqli_fetch_assoc($res);
    
}
?>



<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<title> Lfs Gida</title>
	</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<a href="dashboard.php" class="navbar-brand">LFS GIDA</a>
			<a href="logout.php" class="navbar-brand"><p align="right">Logout</p></a>
		</div>
	</nav>


	<div class="col-sm-3 well">

<!-- Meeting id & password-->

	<form method="POST" action=<?php echo ($bt_m!="" ?  "live_update.php" :"secret.php")?> >
<?php
if($bt_m!="")
{
    ?>
    <div class="form-group">
	<label>Database_Id</label>
	<input type="text" name="database_id" class="form-control" required="required" value="<?php echo $resp['id'] ?>" />
</div>
<?php
}
?>
<div class="form-group">
	<label>Meeting ID</label>
	<input type="text" name="Meeting_ID" class="form-control" value="<?php echo $resp['meeting_id'] ?>" required="required"/>
</div>

<div class="form-group">
	<label>Meeting Password</label>
	<input type="text" name="Meeting_pass" value="<?php echo $resp['meeting_pass'] ?>" class="form-control" required="required"/>
</div>

<div class="form-group">
	<label>Class</label>
	
		<input type="text" name="Api_class" value="<?php echo $resp['class'] ?>" class="form-control" required="required"/>

</div>

<center><button name="submit" class="btn btn-primary"><?php echo ($bt_m!=""? "update" :"save" ); ?></button></center>
</form>


<?php include_once 'viewsec.php'?>


</div>

</div>
<!--  border-->
	<div class="col-md-9 well ml-3">

		<h3 class="text-primary">DASHBOARD</h3>
		<hr style="border-top:1px dotted #ccc;" />

		
		
		<div class="col-md-3">


			<?php
			if($dt=="edit")
			{
			?>
				<form method="POST" action="update_student.php">
		<?php
			}
			else
			{
				?>
				<form method="POST" action="insert.php">

			<?php
			}
			?>		
			
				<div class="form-group">
					<label>Admin no</label>
					<input type="text" name="admin_no"  value="<?php echo $resp['admno'] ?>" class="form-control" required="required"/>
				</div>

				<div class="form-group">
					<label>Name</label>
					<input type="text" name="firstname" value="<?php echo $resp['student_name'] ?>" class="form-control" required="required"/>

				</div>

				<div class="form-group">
					<label>Class</label>
					
						<input type="text" name="class" value="<?php echo $resp['std'] ?>" class="form-control" required="required"/>
					
					
				</div>

				<div class="form-group">
					<label>Section</label>
					<input type="text" name="sec" class="form-control" value="<?php echo $resp['sec'] ?>" required="required" />
				</div>


				<div class="form-group">
					<label>Password</label>
					<input type="text" name="password" value="<?php echo $resp['password'] ?>" class="form-control" required="required"/>
				</div>
				
				
					
		            	<?php
		        	if($dt=="edit")
		        	{
		        	    ?>
		        	    <div class="form-group">
					<label>Status</label>
					<select class="form-select form-select-lg mb-3" name="user_status" aria-label="Default select example" required="required">
					    
 					
 					<?php
		        	    $st=$resp['user_status'];
		        	    $st=($st=="" or $st=="NULL")?"NULL":"login";
		        	    if($st=="NULL")
		        	    {
		        	        ?>
		        	        <option value="NULL" selected> Logout</option>
		        	        <option value="Login" > Login</option>
		        	       <?php
		        	    }
		        	    else
		        	    {
		        	        ?>
		        	         <option value="Login" selected> Login</option>
		        	         <option value="NULL" > Logout</option>
		        	     <?php
		        	    }
		        	    ?>
		        	     </select>

				</div>
				<?php
		        	}
		        	        ?>
		        	    
					 

				
				<center><button name="save" class="btn btn-primary"><?php echo $bt ?></button></center>


			</form>


		</div>
		<div class="col-md-9">
			<form method="POST" action="">
				<div class="form-inline">
				    
					<input type="search" class="form-control" name="keyword" value="<?php echo isset($_POST['keyword']) ? $_POST['keyword'] : '' ?>" placeholder="Search here..." />
					
					<div class="form-group">
	<label>Class</label>
<select class="form-select" name="st_class" aria-label="Default select example" >
  <option selected>Select Class</option>
  <option value="LKG">LKG</option>
  <option value="UKG">UKG</option> 
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option> 
 
</select>


</div>
					<button class="btn btn-success" name="search" type="submit">Search</button>
					<a href="dashboard.php" class="btn btn-info">Clear</a>
				</div>
			</form>
			<br /><br />
			<?php include'search.php'?>
		</div>
	</div>
</body>
</html>