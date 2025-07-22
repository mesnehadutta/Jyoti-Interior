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
//$conn=mysqli_connect("localhost","root","","decohouse","3306");
//$conn=mysqli_connect("localhost","u588429364_decohouse","2&$1F|FFk","u588429364_decohouse");


$sql1=mysqli_query($con,"SELECT * FROM admin where ID='1'");
$result1 =mysqli_fetch_assoc($sql1);

$sql2="SELECT * FROM user_reg"; 
$result2 = $con->query($sql2);
?>
<!doctype html>
<html lang="en">

<head>

<meta charset="utf-8" />
<title>Project Details</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
<meta content="Themesdesign" name="author" />
<!-- App favicon -->
<link rel="shortcut icon" href="../assets/img/icon10.png">

<link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css">

<link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

<link href="assets/libs/spectrum-colorpicker2/spectrum.min.css" rel="stylesheet" type="text/css">

<link href="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">

<!-- Bootstrap Css -->
<link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body data-topbar="dark">

<!-- <body data-layout="horizontal" data-topbar="dark"> -->

<!-- Begin page -->
<div id="layout-wrapper">


<header id="page-topbar">
<div class="navbar-header">
<div class="d-flex">
<!-- LOGO -->
<div class="navbar-brand-box">


<a href="../index.php" class="logo logo-light">
<span class="logo-sm">
<img src="../assets/img/icon10.png" alt="logo-sm-light" height="22">
</span>
<span class="logo-lg">
<img src="assets/images/icon.png" alt="logo-light" height="35">
</span>
</a>
</div>

<button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
<i class="ri-menu-2-line align-middle"></i>
</button>


</div>

<div class="d-flex">

<div class="dropdown d-inline-block user-dropdown"> 
<button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<img class="rounded-circle header-profile-user" src="assets/images/users/av1.jpg"
alt="Header Avatar">
<span class="d-none d-xl-inline-block ms-1"><?php echo $result1['name']; ?></span>
<i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
</button>
<div class="dropdown-menu dropdown-menu-end">
<!-- item-->
<a class="dropdown-item" href="editprofile.php"><i class="ri-user-line align-middle me-1"></i> Profile</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item d-block" href="change password.php"><i class="ri-settings-2-line align-middle me-1"></i> Change Password</a>
<a class="dropdown-item text-danger" href="get_consultation_data.php?logout='1'"><i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
</div>
</div>
</div>
</div>
</header>
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

<div data-simplebar class="h-100">

<!-- User details -->
<div class="user-profile text-center mt-3">
<div class="">
<img src="assets/images/users/av1.jpg" alt="" class="avatar-md rounded-circle">
</div>
<div class="mt-3">
<h4 class="font-size-16 mb-1"><?php echo $result1['name']; ?></h4>
</div>
</div>

<!--- Sidemenu -->
<div id="sidebar-menu">
<!-- Left Menu Start -->
<ul class="metismenu list-unstyled" id="side-menu">
<li class="menu-title">Menu</li>

<li>
<a href="get_consultation_data.php" class="waves-effect">
<i class="ri-dashboard-line"></i>
<span>Enquiry</span>
</a>
</li>

<li>
<a href="javascript: void(0);" class="has-arrow waves-effect">
<i class="ri-layout-3-line"></i>
<span>Add Data</span>
</a>
<ul class="sub-menu" aria-expanded="false">
<li><a href="add_image.php">Images</a></li>
<li><a href="youtube.php">You_Tube_Links</a></li>
<li><a href="project_details.php">Project Details</a></li>
</ul>
</li>

<li>
<a href="javascript: void(0);" class="has-arrow waves-effect">
<i class="ri-profile-line"></i>
<span>Display</span>
</a>
<ul class="sub-menu" aria-expanded="false">
<li><a href="display_image.php">Images</a></li>
<li><a href="display_youtube_links.php">You_Tube_Links</a></li>
<li><a href="display_project.php">Project</a></li>


</ul>
</li>


</ul>
</div>
<!-- Sidebar -->
</div>
</div>
<!-- Left Sidebar End -->



<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

<div class="page-content">
<div class="container-fluid">

<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
<h4 class="mb-sm-0">Project Details</h4>



</div>
</div>
</div>
<!-- end page title -->

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">



<form method="POST" action="insert_project.php" enctype="multipart/form-data">
<div class="row mb-3">
<label class=" col-sm-2 col-form-label">Client Name</label>
<div class="col-sm-10">
<select class="form-control select2" name="client_id" required >
<?php
if ($result2->num_rows > 0)
{   
while($row = $result2->fetch_assoc()) {?>
<option value="<?php echo $row['ID'];?>"><?php echo $row['firstname'] .' '. $row['lastname']; ?></option>
<?php
}
}?>

</select>
</div>
</div>    

<div class="row mb-3">
<label for="example-date-input" class="col-sm-2 col-form-label">Start Date</label>
<div class="col-sm-10">
<input class="form-control" type="date" name="start-date" value="" id="example-date-input" required>
</div>
</div>
<div class="row mb-3">
<label for="example-date-input" class="col-sm-2 col-form-label">Expected End Date</label>
<div class="col-sm-10">
<input class="form-control" type="date" name="end-date" value="" id="example-date-input" required>
</div>
</div>
<div class="row mb-3">
<label for="example-date-input" class="col-sm-2 col-form-label">Client Address</label>
<div class="col-sm-10">
<input class="form-control" type="text" name="client_address" value="" id="" placeholder="Client Address" required>
</div>
</div>
<div class="row mb-3">
<label for="example-text-input" class="col-sm-2 col-form-label">Project Details</label>
<div class="col-sm-10">
<input class="form-control" type="text" name="project" placeholder="Description" required id="example-text-input">
</div>
</div>
<div class="row mb-3">
<label for="example-text-input" class="col-sm-2 col-form-label">Total Amount</label>
<div class="col-sm-10">
<div class="input-group mb-2">
<div class="input-group-prepend">
<div class="input-group-text">₹</div>
</div>
<input class="form-control" type="text" name="total_amount" placeholder="Amount" required id="example-text-input">
</div>
</div></div>
<div class="row mb-3">
<label for="example-text-input" class="col-sm-2 col-form-label">Part Amount Paid</label>
<div class="col-sm-10">
<div class="input-group mb-2">
<div class="input-group-prepend">
<div class="input-group-text">₹</div>
</div>
<input class="form-control" type="text" name="amount_paid" placeholder="Amount" required id="example-text-input">
</div>
</div></div>

 <div class="row mb-3">
 <label class="col-sm-2 col-form-label">Client Image</label>
            <div class="col-sm-10">
                <div class="input-group">
            <input type="file" class="form-control" name="images[]" id="images" multiple required >
            </div>
            </div>
            </div>
 <input type="submit" value="Upload" class="btn btn-info waves-effect waves-light" name="upload">
</div>

</div>


</form>

</div>
</div>
<!-- end select2 -->

</div>


</div>
<!-- end row -->

<!-- end row -->


</div> <!-- end col -->


</div> <!-- end col -->
</div> <!-- end row -->



</div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

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
<!-- end main content-->

</div>
<!-- END layout-wrapper -->



<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/metismenu/metisMenu.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>

<script src="assets/libs/select2/js/select2.min.js"></script>
<script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
<script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js"></script>
<script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>

<script src="assets/js/pages/form-advanced.init.js"></script>

<script src="assets/js/app.js"></script>

</body>
</html>
