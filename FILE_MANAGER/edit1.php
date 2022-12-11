<?php 
    require_once("conn.php");
    $admin_no = $_GET['admin_no'];
    $query = " select * from member where admin_no='".$admin_no."'";
    $result = mysqli_query($conn,$query);

    while($row=mysqli_fetch_assoc($result))
    {
        $admin_no = $_POST['admin_no'];
		$firstname = $_POST['firstname'];
		$class = $_POST['class'];
		$sec = $_POST['sec'];
		$password = $_POST['password'];
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" a href="CSS/bootstrap.css"/>
    <title>Document</title>
</head>
<body class="bg-dark">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="card mt-5">
                        <div class="card-title">
                            <h3 class="bg-success text-white text-center py-3"> Update Form in PHP</h3>
                        </div>
                        <div class="card-body">

                            <form action="update.php?ID=<?php echo $UserID ?>" method="post">



                           
					<input type="text" name="admin_no" placeholder=" Admin no " class="form-control"  value="<?php echo $admin_no ?>"/>
					<input type="text" name="firstname"  placeholder=" Name " class="form-control" value="<?php echo $firstname ?>"/>
    				<select class="form-select form-select-lg mb-3"  placeholder="Class" name="class" aria-label="Default select example"  value="<?php echo $class ?>">
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

					<input type="text" name="sec" placeholder="Section"  class="form-control"  value="<?php echo $sec ?>" />
				
					<input type="text" name="password" placeholder=" Password "  class="form-control"  value="<?php echo $password ?>"/>
				
                                 
                                
                                
                                
                                <button class="btn btn-primary" name="update">Update</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    
</body>
</html>