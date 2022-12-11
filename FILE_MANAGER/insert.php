<?php
	//require the database connection
	require_once 'conn.php';
 
	if(ISSET($_POST['save'])){
 		//setting up the variables
		 $admin_no = $_POST['admin_no'];
		$firstname = $_POST['firstname'];
		$class = $_POST['class'];
		$sec = $_POST['sec'];
		$password = $_POST['password'];

	
 
		try{
			//setting attribute on the database handle
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//Inserstion Query
			$sql = "INSERT INTO `students_record`(admno, student_name, std,sec, password)  VALUES ('$admin_no','$firstname', '$class', '$sec', '$password')";
			//Execute Query
			$conn->exec($sql);
		}catch(PDOException $e){
			// Display error message
			echo $e->getMessage();
		}
 		//Closing the connection
		$conn = null;
 		//redirecting to the index page
		header("location: index.php");
 
	}










?>