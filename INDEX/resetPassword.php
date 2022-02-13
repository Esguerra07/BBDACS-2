<?php 

  $msg = "";
  include('config/mydb.php');
  if (!isset($_GET['code'])) {
    # code...
    exit(include("notFound.php"));
  }
  $code = $_GET['code'];
  $getEmail = mysqli_query($conn, "SELECT email FROM resetpassword WHERE code ='$code'");
   $row = mysqli_fetch_array($getEmail);
  $emailGot = $row['email'];

  if (mysqli_num_rows($getEmail) == 0) {
    # code...
   exit(include("notFound.php"));

  }
  date_default_timezone_set("Africa/Lagos");
  $sql1 = "SELECT TIMESTAMPDIFF (SECOND, date, NOW()) AS tdif FROM resetpassword WHERE code = '$code'";
  $result = $conn->prepare($sql1);
  $result->execute();
  $result->store_result();
  $result->bind_result($tdif);
  $result->fetch();

  if ($tdif >= 900) {
    # code...
    $removeQuery = $conn->query("DELETE FROM resetpassword WHERE code = '$code'");
     exit(include("sessionTimeout.php"));
  }

  if (isset($_POST['submit'])) {
    # code...
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
     //validate paswword
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);

    if ($password == "" || $cpassword == "") {
      # code...
       $msg = "<div class='alert alert-danger alert-dismissible'>
   <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Password can not be empty! </div>";
    }
    else{
      if ($password != $cpassword) {
        # code...
         $msg = "<div class='alert alert-danger alert-dismissible'>
   <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Oops! Passwords did not match! Try aagin </div>";
      }
      elseif (!$uppercase || !$lowercase || !$number|| strlen($password) < 8) {
        # code...
        $msg = "<div class='alert alert-danger alert-dismissible'>
   <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Password must be 8 characters in length with atleast one uppercase and lowercase letter and one numeric <strong>e.g Viralskill2471<strong></div>";
      }
      else {
       
     $password = password_hash($password, PASSWORD_BCRYPT);
     $query = mysqli_query($conn, "UPDATE user SET password = '$password' WHERE email = '$emailGot'");
     if ($query) {
       # code...
          $query = $conn->query("DELETE FROM resetpassword WHERE code = '$code'");
          $msg = "<div class='alert alert-success alert-dismissible'>
   <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Password Updated! successfully <a class='loginHome' href='login-user.php'>Click to Login</a></div>";
     }

     else{
    $msg = "<div class='alert alert-danger alert-dismissible'>
   <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something went wrong! contact the admin!</div>";

     }

    }
  }

  } 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <title>Password Reset</title> 
  <link rel="stylesheet" type="text/css" href="style-resetpassword.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" />
</head>
<body class="bg-gray">      

    <!-- ##### Newsletter Area Start ###### -->
    <section style="margin-top: 40px;">
         <div class="container">
    <div class="row">
        <div class="col-md-4"></div>
          <div class="col-md-4">
               

                   <div class="admin-box-login">
    
<form class="text-center border border-light p-4" action="" method="post">
    <h5 style="margin-top: 20px; text-align: center; font-size: 25px; font-weight: 900; font-family: sans-serif; color: white; letter-spacing: -2px;">Password Reset</h5><br>
    <p><?php echo $msg; ?></p>
  <input type="password" name="password" id="typepass" class="form-control1 mb-4" style="background:white; color:black;" placeholder=" New password..."><br>
  <input type="password" name="cpassword" id="typepass2" class="form-control1 mb-4" style="background:white; color:black;" placeholder=" Confirm password..."> <br> 
   <input type="checkbox" style="float: left; margin-left: 20px;" onclick="Toggle()" > 
   <p style="float: left; margin-left: 5px; color: white;"> Show</p><br><br>   
    <button class="btn admin-reg-btn btn-block" name="submit" style="background:rgb(109, 16, 4); text-decoration:none; color:white;font-size:18px; font-weight: 700; width: 90%; margin: auto auto;" type="submit">RESET</button><br>


</form>
<br><br>
       </div>
         </div>

          <div class="col-md-4"></div>
    </div>  
       
   </div> 
      </section>    
</body>
 <script> 
    // Change the type of input to password or text
    function Toggle(){
var pass = document.getElementById("typepass");
var pass2 = document.getElementById("typepass2");
  if (pass.type === "password") {
    pass.type = "text";
  }
    if (pass2.type === "password") {
    pass2.type = "text";
  }
  else{
    pass.type = "password";
   pass2.type = "password";

  }


    } 
  
</script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
</html>