<?php
require_once('header.php');
require_once 'connection.php';
$msg="";


    
?>

 
<Style>
    
/* Style inputs, select elements and textareas */
input[type=text], input[type=password],select, textarea{
  width: 60%;
  padding: 12px;
 
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  resize: vertical;
 
}

/* Style the label to display next to the inputs */
label {
  padding: 12px 12px 12px 0;
  margin-left:60%;
  
  display: inline-block;
}

/* Style the submit button */
input[type=submit] {
  background-color: #04AA6D;
  color: white;
  width:10%;
  margin-top:40px;
  margin-left:40%;
  margin-right:50%;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

/* Style the container */
.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

/* Floating column for labels: 25% width */
.col-25 {
  float: left;
  width: 45%;
  margin-top: 6px;
}

/* Floating column for inputs: 75% width */
.col-75 {
  float: left;
  width: 55%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}

    </style>

<div class="container">
  <form action="web_login.php" method="POST">
  <div class="row">
  <?php
if($msg!="")
{
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Message </strong> <strong> <?php echo $msg; ?></strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
?>
    </div>
  <div class="row">
      <h1 style="text-align: center;"> Login Form </h1>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="fname">User Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="username" name="login_id" placeholder="Your name.." required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Password</label>
      </div>
      <div class="col-75">
        <input type="password" id="password" name="password" data-toggle="password" placeholder="Password  "  required><br>
        <input type="checkbox" onclick="myFunction()">Show Password
      </div>
    </div>
 
    <div class="row">
      <input type="submit" value="login" name="login">
    </div>
  </form>
</div>

<!----------- Caraousel End her--------------------->

   <script>
       function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
<?php
require_once "footer.php";
?>
