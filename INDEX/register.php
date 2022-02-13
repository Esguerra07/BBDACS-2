<?php

    $result="";

    if(isset($_POST['submit'])){

        include("config/mydb.php");

        $username = $_POST['username'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phoneno = $_POST['phoneno'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        //validate password
        $uppercase=preg_match('@[A-Z]@',$password);
        $lowercase=preg_match('@[a-z]@',$password);
        $number = preg_match('@[0-9]@',$password);
       
        //date
        date_default_timezone_set("Africa/Lagos");
        $date_created= date('M d, Y \a\t h:ia',time());
        //recaptcha
        $secretKey="6LfQ-ysdAAAAAHtwZl-Ys_ghuxv14UJ_iMYIJXs4";
        $responseKey=$_POST['g-recaptcha-response'];
        $userIP=$_SERVER['REMOTE_ADDR'];
        $url= "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";

        $response=file_get_contents($url);
        $responses=json_decode($response);
        //var-dump($response);
        if ($username=="" || $email == "" || $address == "" || $phoneno =="" || $password== "" || $cpassword == "" ){
            $result = "<div class='alert alert-danger alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Please check your inputs, All fields are required!</div>";
        }
        else{
            if(!preg_match("/^[a-zA-Z\s]+$/",$username))
            {
                $result = "<div class='alert alert-danger alert-dismissible'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Username should contain only letters! <strong>e.g Daniel</strong></div>";
             
            }
            else if(strlen($username)<6){
                $result = "<div class='alert alert-danger alert-dismissible'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Username should contain atleast 6 Characters!</div>";
             
            }
            else if(strlen($username)>15){
                $result = "<div class='alert alert-danger alert-dismissible'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Username should not exceed 15 characters!</div>";
                 
            }
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                # code...
               $result = "<div class='alert alert-danger alert-dismissible'>
              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>You entered an Invalid Email Format!</div>";
            }
            else if(!preg_match('/^[0-9]*$/',$phoneno)){
                $result = "<div class='alert alert-danger alert-dismissible'>
              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Should contain only number!</div>";
            }
            else if(strlen($phoneno)<11){
                $result = "<div class='alert alert-danger alert-dismissible'>
              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Please enter valid mobile number!</div>";
            }
            else if(strlen($phoneno)>11){
                $result = "<div class='alert alert-danger alert-dismissible'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Do not enter more than 11 numbers!</div>";
            }
            elseif ($password != $cpassword) {
                # code...
               $result = "<div class='alert alert-danger alert-dismissible'>
              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Your password does not match!</div>";
              }
           
            elseif (!$uppercase || !$lowercase || !$number || strlen($password) < 8 ) {
                # code...
               $result = "<div class='alert alert-danger alert-dismissible'>
              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Password must be 10 characters in length with atleast one uppercase and lowercase letter, one numeric and special character <strong>King4life+</strong></div>";
           
              }
            elseif (empty($_POST['checkbox'])) {
                # code...
              $result = "<div class='alert alert-danger alert-dismissible'>
              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Check the box, to agree to our site policy!</div>";
              }
              else{
                  $sql = $conn->query("SELECT id FROM user WHERE email = '$email'");
                  if ($sql->num_rows > 0) {
                  # code...
                    $result = "<div class='alert alert-danger alert-dismissible'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Email already exists in the database</div>";
                
                }
                elseif (!$responses->success) {
                  # code...
                  $result = "<div class='alert alert-danger alert-dismissible'>
                  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Check the box, to ensure your not a robot.</div>";
              
              }
              else{
                $length = 8;
                $code = strtoupper(substr(md5(time()), 0, $length));
                $finalcode = '?'.$code;
                $user_reg = $username.$finalcode;
                
                $token = 'qwertyuiopasfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789!"£$%^&*()_+@';
                $token_1 = str_shuffle($token);
                $final_token = substr($token_1, 0, 10);
                
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $sql = $conn->query("INSERT INTO user (username, email, address, phoneno, password, Email_status, token, reg_id, date_created) VALUES ('$username', '$email', '$address', '$phoneno', '$hashedPassword', '0', '$final_token', '$user_reg', '$date_created')");
                
                if ($sql) {
                    # code...
                    include('mailer.php');
                  }
                  
            }
                  
        }
                  
       }
                  
                  
    }

?>
<html lang="en">
    <head>
      <meta charset="utf-8">
       <meta name="description" content="">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>User Registration System </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
          <link rel="stylesheet" type="text/css" href="style-reg.css">
      <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" />
     
    </head>
     <body>
  
  
   <div class="container">
    <div class="row">
    <div class="col-md-3"></div>
      <div class="col-md-6">
        
  
  <!-- Default form login -->
         <div class="admin-box-form">
  <form class="border border-light" action="" method="post">   
     <div class="form-row">
      <div class="col-12 text-center" style="margin-bottom: 5%;">
          <h4 class="text-center" style="font-size: 30px; font-weight: 900; font-family: sans-serif; color: white; letter-spacing: -2px;">Register</span></h4> 
          
        </div>
        <p> <?php echo $result; ?> </p>
    <div class="form-group col-md-6">
        
       <label class="mb-2"><p class="support-p"><strong>Username:</strong></p></label>
      <input type="text" name="username" 
      class="form-control mb-4" placeholder="Enter your username..">
       <br>
    </div>
    <div class="form-group col-md-6">
       <label style="float: left;" class="mb-2"><p class="support-p"><strong>Email:</strong></p></label>     
      <input type="text" name="email"  
      class="form-control mb-4" placeholder="Enter your email..">
      <br>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
       <label style="float: left;" class="mb-2"><p class="support-p"><strong>Address:</strong></p></label>    
      <input type="text" name="address" 
      class="form-control mb-4" placeholder="Enter your address..">
       <br>
     </div>
       <div class="form-group col-md-6">
        <label style="float: left;" class="mb-2"><p class="support-p"><strong>Mobile Number:</strong></p></label>    
      <input type="text" name="phoneno"  
      class="form-control mb-4" placeholder="Enter your mobile number..">
       <br>
     </div>
   </div>
  <div class="form-row">
    <div class="form-group col-md-6">
       <label style="float: left;" class="mb-3"><p class="support-p"><strong>Password:</strong></p></label>  
      <input type="password" name="password" class="form-control mb-4" placeholder="Password...">
      </div>
           <div class="form-group col-md-6">
      <label style="float: left;" class="mb-3"><p class="support-p"><strong>Confirm Password:</strong></p></label>    
      <input type="password" name="cpassword" class="form-control mb-4" placeholder="Confirm Password..."> 
         </div> 
       </div>
      <!-- agreement -->
          <div class="custom-control custom-checkbox" style="padding-left: 15px;">
   <input type="checkbox" class="custom-control-input" name="checkbox">
   <label class="custom-control-label"><a href="#" class="link">
    I agree to the <strong> terms & condition </strong> and <strong>privacy policy</strong></a>
  </label>
          </div>
          <br>
          <!--recaptcha-->
          <div style="margin-left:3%;"class="g-recaptcha" data-sitekey="6LfQ-ysdAAAAAKduozL6xURjTcBtfZoFgVk4brsR"></div>
             <br>
  <button class="btn admin-reg-btn btn-block" name="submit" type="submit"><strong>SIGN UP</strong></button>
        <br>
        <br>
        <p class="text-center" style="color: white;">Already have an account?
          <a href="login-user.php" class="link"><strong>Login</strong></a>  
  
      </p>   
    
  </form>
         
     
  </div>
       
    </div>
      <div class="col-md-3"></div>
    </div>  
  </div>
  
  </body>
  <div class="mt-30"></div>
      <script src="https://www.google.com/recaptcha/api.js" async defer></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
     </body>
  </html>