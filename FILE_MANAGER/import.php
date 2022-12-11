<?php
require_once 'db.php';
if(isset($_POST["Import"])){
	$filename=$_FILES['file']['tmp_name'];

	
 
		 if($_FILES["file"]["size"] > 0)
		 {
 
		  	$file = fopen($filename, "r");
	         while (($data = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
				
	          $sql="INSERT INTO `students_record` (`id`, `admno`, `student_name`, `std`, `sec`, `password`, `user_status`) VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[6]')";
			$result=$conn->query($sql);
			


			
	         }
	         fclose($file);
	         //throws a message if data successfully imported to mysql database from excel file
	         echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"dashboard.php\"
					</script>";
 
 
 
			 //close of connection
			mysqli_close($conn); 
 
 
 
		 }
	}
	 
?>
