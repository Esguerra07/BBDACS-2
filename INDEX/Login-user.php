<?php
session_start();
include('config/mydb.php');
function redirectToLoginPage(){
  header('Location: Home.php?LoginSuccess');
  exit();
}
if (isset($_SESSION['email'])) {
  # code...
  redirectToLoginPage();
}

$msg = '';

if (isset($_POST['submit'])) {
  # code...
  $email = $_POST['email'];
  $password = $_POST['password'];
  if ($email == "" || $password == "") 
    # code...
    $msg = "<div class='alert alert-danger alert-dismissible'>
   <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Email or Password can not be empty!</div>";
  else{
    $sql = $conn->query("SELECT id, password, Email_status FROM user WHERE email = '$email'");

    if ($sql->num_rows > 0) {
      
      # code...
      $data = $sql->fetch_array();
      if (password_verify($password, $data['password'])) {
        # code...
        if ($data['Email_status'] == 0) 
          # code...
          $msg = "<div class='alert alert-danger alert-dismissible'>
   <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Please verify your email address to activate your account</div>";     
   else {
     if (!empty($_POST['remember_me'])) {
       # code...
      setcookie("email", $email, time()+30*24*60*60);
      setcookie("password", $password, time()+30*24*60*60);

     } else {
       setcookie("email", "");
      setcookie("password", "");
     }
     //include seession user here
     $_SESSION['email'] = $email;
     //log use in
     redirectToLoginPage();

   }   

      }

else 
  $msg = "<div class='alert alert-danger alert-dismissible'>
   <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>You Entered Wrong Email or Password!</div>";  


    }
else {
 $msg = "<div class='alert alert-danger alert-dismissible'>
   <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>You Entered Wrong Email or Password! Please check your inputs</div>"; 

}

  }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="User login">
    <title>User Login</title>
    <!-- Stylesheet -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="style-log.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" />

</head>

   <body>

<div class="mt-faq"></div>

<div class="container">
<div class="row">
    <div class="faq-head">
    <div class="col-12 text-center">
     <a href="index.php"></a><br><br>
       
       </div>
     </div>
   </div>
 </div>

 <div class="container">
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
<!--  form login -->
   

       <div class="admin-box-login">

<form class="border border-light" action="" method="post"> 
    <h4 class="aim" style="text-align: center;font-size: 25px; font-weight: 900; font-family: sans-serif; color: white; letter-spacing: -2px;">User Login</span></h4> 
    <br>
    <p><!-- echo message--><?php echo $msg; ?></p>
    <label style="float: left;" class="mb-1"><p class="support-p"><strong>Email Address:</strong></p></label>    
    <input type="text" name="email" value="<?php if(isset($_COOKIE["email"])) { echo $_COOKIE["email"]; } ?>"
    class="form-control mb-4" placeholder="Enter your email address..."><br>    

     <label style="float: left;" class="mb-1"><p class="support-p"><strong>Password:</strong></p></label>
     <input type="password" name="password"   value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" 
         class="form-control mb-4" placeholder="Password..."><br> 

  <input type="checkbox" class="custom-control-input" name="remember_me"  <?php if(isset($_COOKIE["email"])) { ?>  <?php } ?> >
 <label class="custom-control-label"><a href="#" class="link">
  <strong>Remember Me</strong></a>
</label>
<br><br>
<button class="btn admin-reg-btn btn-block" name="submit" type="submit"><strong>Login</strong></button>   
  
</form>
<br>  
<p class="support-p">
<a href="forgotPassword.php" class="ps" style=" float: right; font-size: 14px;"><strong>Forgot Password?</strong>
</a>  
<br>
<br>
</p>
<p class="text-center" style="color: white;">Don't Have an Account?    
  <a href="register.php" class="link"><strong>Create</strong></a> 
</p>
    <br><br>
</div>
     
  </div>
    <div class="col-md-4"></div>
  </div>  
</div>
</body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
</html>