<?php
	// require the database connection
	require 'conn.php';
	
?>
<br>
<table class="table table-bordered">
		<thead class="alert-info">
			<tr>
				
				<th>Class</th>
				<th>Meeting ID</th>
				<th>Meeting Password</th>
				<th>Action</th>
				
			</tr>
		</thead>
		<tbody>
			<?php
				$query = $conn->prepare("SELECT * FROM `live_credit`");
				$query->execute();
				while($row = $query->fetch()){
			?>
			<tr>
			
				<td><?php echo $row['class']?></td>
				<td><?php echo $row['meeting_id']?></td>
				<td><?php echo $row['meeting_pass']?></td>
				<td><a href="dashboard.php?edit_credit=<?php echo $row['id']; ?>" >
				<button type="button" class="btn btn-success">Edit</button></a></td>
				

			</tr>
			
			
			<?php
				}
			?>
		</tbody>
	</table>
<?php
	
$conn = null;
?>