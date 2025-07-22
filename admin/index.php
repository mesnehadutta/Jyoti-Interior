<?php
   include("../dbconnection.php");
   if (session_status() === PHP_SESSION_NONE) {
      session_start();
   }
   
   if($_SERVER["REQUEST_METHOD"] == "POST") 
   {
      // username and password sent from form 
      
      $email = mysqli_real_escape_string($con,$_POST['email']);
      $password = mysqli_real_escape_string($con,$_POST['password']);

      
      $sql = "SELECT * FROM admin WHERE email='".$email."'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
      
      if($count == 1) 
     {
    $dbemail=$row['email'];
    $dbpassword=$row['password'];
    }
    if($email == $dbemail && $password == $dbpassword)
    {
    session_start();
    $_SESSION['sess_email']=$email;
    echo '<script>alert("Login Successfull")</script>';
    echo'<script>window.location.href = "get_consultation_data.php"</script>';
    }  
    else
      {
         echo '<script>alert("Your Login Name or Password is invalid")</script>';
             //echo'<script>window.location.href = "index.php"</script>';
      }
   }
         
?>

<!doctype html>
<html lang="en">

<head>

<meta charset="utf-8" />
<title>Admin Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
<meta content="Themesdesign" name="author" />
<!-- App favicon -->
<link rel="shortcut icon" href="../assets/img/icon10.png">

<link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css"/>

<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

<link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body class="auth-body-bg">
<div class="bg-overlay"></div>
<div class="wrapper-page">
<div class="container-fluid p-0">
<div class="card">
<div class="card-body">

<div class="text-center mt-4">
<div class="mb-3">
<a href="index.php" class="auth-logo">
<img src="assets/images/icon.png" height="40" width="" class="logo-dark mx-auto" alt="">
<!--<img src="assets/images/logo-light.png" height="30" class="logo-light mx-auto" alt="">-->
</a>
</div>
</div>

<h4 class="text-muted text-center font-size-18"><b>Sign In</b></h4>

<div class="p-3">
<form class="form-horizontal mt-3" method="POST" action="">

<div class="form-group mb-3 row">
<div class="col-12">
<input class="form-control" type="email" name="email" required="" placeholder="Email">
</div>
</div>

<div class="form-group mb-3 row">
<div class="col-12">
<input class="form-control" type="password" required="" name="password" placeholder="Password">
</div>
</div>

<div class="form-group mb-3 row">
<div class="col-12">
<!--<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input" id="customCheck1">
<label class="form-label ms-1" for="customCheck1">Remember me</label>
</div>-->
</div>
</div>

<div class="form-group mb-3 text-center row mt-3 pt-1">
<div class="col-12">
<button class="btn btn-info w-100 waves-effect waves-light" name="login"  type="submit">Log In</button>
</div>
</div>

</div>
</form>
</div>
<!-- end -->
</div>
<!-- end cardbody -->
</div>
<!-- end card -->
</div>
<!-- end container -->
</div>
<!-- end -->

<!-- JAVASCRIPT -->
<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/metismenu/metisMenu.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>

<script src="assets/js/app.js"></script>

</body>
</html>
