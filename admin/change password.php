<?php


 session_start();
 $email=$_SESSION['sess_email'];
if (isset($_GET['logout']))
  {
 
      
  unset($_SESSION['sess_email']);
  session_destroy();
  header("Location:../index.php");
}

if(empty($_SESSION['sess_email']))
{
 header("Location:../index.php");

}

include('../dbconnection.php');


//$conn=  mysqli_connect("localhost","root","","decohouse","3306");
$sql=mysqli_query($con,"SELECT * FROM admin where ID='1'");
$result1 =mysqli_fetch_assoc($sql);


if(isset($_POST['submit']))
{
 $oldpass=($_POST['oldpwd']);
 $newpassword=($_POST['newpwd']);
 $confirmpasswod=($_POST['conpwd']);

 if($newpassword==$confirmpasswod)
{   
$sql=mysqli_query($con,"SELECT password FROM admin where password='$oldpass'");
$num=mysqli_fetch_array($sql);
if($num>0)
{
 $con=mysqli_query($con,"update admin set password=' $newpassword'");
echo '<script>alert("Password Changed Successfully !!")</script>';
 echo'<script>window.location.href = "change password.php"</script>';
}
}
else{
    echo'<script>alert("newpassword not match confirmpasswod!!")</script>';
    echo'<script>window.location.href = "change password.php"</script>';
}
}
?>



<!doctype html>
<html lang="en">

<head>

<meta charset="utf-8" />
<title>Change Password</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
<meta content="Themesdesign" name="author" />
<!-- App favicon -->
<link rel="shortcut icon" href="../assets/img/icon10.png">

<!-- DataTables -->
<link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />     

<!-- Bootstrap Css -->
<link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body data-topbar="dark">
<div id="layout-wrapper">


<?php include('topbar.php') ?>

<!-- ========== Left Sidebar Start ========== -->
<?php include('sidebar.php') ?>
<!-- Left Sidebar End -->





<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

<div class="page-content">
<div class="container-fluid">

<div class="row">

<div class="col-xl-12">
<div class="card">
<div class="card-body">

<h4 class="card-title">Change Password</h4>


<form action="" method="POST" class="custom-validation">

<div class="mb-3">
<label>Old Password</label>
<div>
<input type="text" class="form-control" required="" name="oldpwd" placeholder="Old Password" readonly value="<?php echo $result1['password'];?>">
</div>
</div>
<div class="mb-3">
<label>New Password</label>
<div>
<input type="text" class="form-control" required="" name="newpwd" placeholder="New Password" value="">
</div>
</div>
<div class="mb-3">
<label>Confirm Password</label>
<div>
<input type="Password" class="form-control" required="" name="conpwd" placeholder="Confirm Password" value="">
</div>
</div>


<div class="mb-0">
<div>
<input type="submit" class="btn btn-info" name="submit" value="Change Password"></button>
<button type="reset" class="btn btn-secondary waves-effect">
Cancel
</button>
</div>
</div>
</form>

</div>
</div>
</div> <!-- end col -->
</div>


</div> <!-- container-fluid -->
</div>
<!-- End Page-content -->


</div>
<!-- end main content-->


  <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                               © Deco House
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                   Designed and Developed  <i class="mdi mdi-heart text-danger"></i>  by <a href="https://www.pbainst.in/" class="text-danger">PBA INSTITUTE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>


</div>
<!-- END layout-wrapper -->


<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/metismenu/metisMenu.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>

<!-- Plugins js -->
<script src="assets/libs/moment/min/moment.min.js"></script>
<script src="assets/libs/bootstrap-editable/js/index.js"></script>

<!-- Init js-->
<script src="assets/js/pages/form-xeditable.init.js"></script>   

<script src="assets/js/app.js"></script>

</body>
</html>