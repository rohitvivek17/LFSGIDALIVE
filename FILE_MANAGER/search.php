
<form class="form-horizontal well" action="import.php" method="post" name="upload_excel" enctype="multipart/form-data">
					<fieldset><div>
					    
					    <table style="width:100%">
  <tr>
    <th><label>CSV/Excel File:</label></th>
    <th><input type="file" name="file" id="file" class="input-large" required></th>
   <th><button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button></th>
   
    <th><a href="upload.csv"><button button type="button" class="btn btn-warning">Sample file</button></a></th>
    
    
  </tr>
 </table></div>
					
 
					</fieldset>
				</form>








<?php
	// require the database connection
	require 'conn.php';
	if(ISSET($_POST['search'])){
	    
	    ?>
	    <!----------------------------------------------------------------->
	    <style>
        table.table {
            width: 100%;
              
            /* border-collapse: collapse; */
            border-spacing: 0;
            border: 2px solid black;
        }
          
        /* To display the block as level element */
        table.table tbody, table.table thead {
            display: block;
        } 
          
        thead tr th {
            height: 40px; 
            line-height: 40px;
        }
          
        table.table tbody {
              
            /* Set the height of table body */
            height: 500px; 
              
            /* Set vertical scroll */
            overflow-y: auto;
              
            /* Hide the horizontal scroll */
            overflow-x: hidden; 
        }
          
        tbody { 
            border-top: 2px solid black;
        }
          
        tbody td, thead th {
            width : 400px;
            border-right: 2px solid black;
        }
        td {
            text-align:center;
        }
    </style>

	    
	    
	    <!----------------------------------------------------------------->
	    
	    
	<table class="table table-bordered">
		<thead class="alert-info">
			<tr>
				<th>Admin No</th>
				<th>Name</th>
				<th>Class</th>
				<th>Section</th>
				<th>Password</th>
				<th>Status</th>
				<th>Action</th>
				
				
			</tr>
		</thead>
		<tbody>
		   
			<?php
			$cl="";
			 if(isset($_POST['st_class']))
			 {
			 $cl=$_POST['st_class'];
			 }
			 
				$keyword = $_POST['keyword'];
				$query = $conn->prepare("SELECT * FROM `students_record` WHERE `student_name` LIKE '%$keyword%' or `std` LIKE '$cl' or `admno` LIKE '%$keyword%' or `sec` LIKE '%$keyword%'");
			 
				$query->execute();
				while($row = $query->fetch()){
			?>
			<tr>
				<td><?php echo $row['admno']?></td>
				<td><?php echo $row['student_name']?></td>
				<td><?php echo $row['std']?></td>
				<td><?php echo $row['sec']?></td>
				<td><?php echo $row['password']?></td>
				<td><?php echo $row['user_status']?></td>
				<td><a href="dashboard.php?edit=<?php echo $row['admno']; ?>" >
				<button type="button" class="btn btn-success">Edit</button></a>
				<a href="dashboard.php?delete=<?php echo $row['admno']; ?>" >
				<button type="button" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger">Delete</button></a>
				</td>
				
				
				
			</tr>
			
			
			<?php
				}
			?>
		</tbody>
	</table>
<?php		
	}else{
?>

<!----------------------------------------------------------------------->

    <style>
        table.table {
            width: 100%;
              
            /* border-collapse: collapse; */
            border-spacing: 0;
            border: 2px solid black;
        }
          
        /* To display the block as level element */
        table.table tbody, table.table thead {
            display: block;
        } 
          
        thead tr th {
            height: 40px; 
            line-height: 40px;
        }
          
        table.table tbody {
              
            /* Set the height of table body */
            height: 500px; 
              
            /* Set vertical scroll */
            overflow-y: auto;
              
            /* Hide the horizontal scroll */
            overflow-x: hidden; 
        }
          
        tbody { 
            border-top: 2px solid black;
        }
          
        tbody td, thead th {
            width : 400px;
            border-right: 2px solid black;
        }
        td {
            text-align:center;
        }
    </style>

<!------------------------------------------------------------------------->
	<table  class="table table-bordered" >
		<thead class="alert-info">
			<tr>
				
				<th>Admin No</th>
				<th>Name</th>
				<th>Class</th>
				<th>Section</th>
				<th>Password</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$query = $conn->prepare("SELECT * FROM `students_record`");
				$query->execute();
				while($row = $query->fetch()){
			?>
			<tr>
				<td><?php echo $row['admno']?></td>
				<td><?php echo $row['student_name']?></td>
				<td><?php echo $row['std']?></td>
				<td><?php echo $row['sec']?></td>
				<td><?php echo $row['password']?></td>
				<td><?php echo $row['user_status']?></td>
				<td><a href="dashboard.php?edit=<?php echo $row['admno']; ?>" >
				<button type="button" class="btn btn-success">Edit</button></a>
				<a href="dashboard.php?delete=<?php echo $row['admno']; ?>" >
				<button type="button" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger">Delete</button></a>
				</td>
				

				
			</tr>

			<?php 
	if (isset($_GET['admin_no'])) {
		$id = $_GET['admin_no'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM member WHERE admin_no=$admin_no");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$firstname = $_POST['firstname'];
			$class = $_POST['class'];
			$sec = $_POST['sec'];
			$user_status = $_POST['user_status'];
			$password = $_POST['password'];
		}
	}
?>
			
			
			<?php
				}
			?>
		</tbody>
	</table>
	

<?php
	}
$conn = null;
?>


