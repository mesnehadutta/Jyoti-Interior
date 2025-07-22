<?php

 session_start();
 $email=$_SESSION['sess_email'];
 $id=$_GET["id"];
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
$sql=mysqli_query($con,"SELECT * FROM admin where ID='1'");
$result =mysqli_fetch_assoc($sql);

$sql1=mysqli_query($con,"SELECT * FROM image where id='" . $_GET["id"] . "'");
$result1 =mysqli_fetch_assoc($sql1);

if (isset($_POST['update']))  
{
    $name=$_POST['name'];
    $description=$_POST['description'];
//$conn=  mysqli_connect("localhost","root","","decohouse","3306");
    $sql3  = "UPDATE image SET name = '$name',description='$description' WHERE id='" .$_GET["id"]."'";

    if($con->query($sql3) === TRUE) 
    {
       echo '<script>alert("Update Successfully")</script>';

        //echo'<script>window.location.href = "editprofile.php"</script>';
    }
  else 
  {
        echo '<script>alert"Erorr while updating record : ". $con->error</script>';
    }
    $con->close();
}
?>

<!doctype html>
<html lang="en">

<head>

<meta charset="utf-8" />
<title>Edit Profile</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
<meta content="Themesdesign" name="author" />
<!-- App favicon --><link rel="shortcut icon" href="../assets/img/icon10.png">

<!-- Plugins css -->
<link href="assets/libs/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css" />

<!-- Bootstrap Css -->
<link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>
<style type="text/css">
    .change-photo-btn {
    background-color: #0097a7;;
    border-radius: 5px;
    color: #fff;
    cursor: pointer;
    display: block;
    font-size: 13px;
    font-weight: 600;
    margin left: 50px;
    padding: 10px 15px;
    position: relative;
    transition: .3s;
    text-align: center;
    width: 150px;
}
.change-photo-btn input.upload {
    bottom: 0;
    cursor: pointer;
    filter: alpha(opacity=0);
    left: 0;
    margin: 0;
    opacity: 0;
    padding: 0;
    position: absolute;
    right: 0;
    top: 0;
    width: 220px;
}
</style>
<body data-topbar="dark">

<!-- <body data-layout="horizontal" data-topbar="dark"> -->

<!-- Begin page -->
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

<h4 class="card-title">Edit Image Details</h4>





  <div class="form-group">
<img src="images/<?php  echo $result1['image'];?>" class="rounded avatar-lg">
<br><br>
<div class="mb-0">
<div>
<form action="change_image.php?id=<?php echo $id;?> " method="post" enctype="multipart/form-data">
                                                        <div class="upload-img" >

                                                            <div class="change-photo-btn">
                                                                <span><i class="fa fa-upload"></i> Upload </span>
                                                                <input type="file" class="upload" name="image">
                                                            </div>
                                                            <input type="submit" name="upload" style="position: relative;  border-radius: 5px; color: white; background-color:#6c757d; width:150px ;padding: 10px 2px;text-align: center;font-size: 13px; height:35px;
                                                            font-weight: 550;cursor: pointer; box-sizing: border-box; border-color: transparent; margin-top: 5px;" value="Submit">
                                                            
                                                        </div>
                                                    </form>

    <br><br>
<div class="mb-3">
<form action="" method="POST" class="custom-validation">
<label> Change Name</label>
<div>
<input type="text" class="form-control" required="" name="name" placeholder="Name" value="<?php echo $result1['name'] ?>">
</div>
<label> Image Description</label>
<div>
<input type="text" class="form-control" required="" name="description" placeholder="Image Description" value="<?php echo $result1['description'] ?>">
</div>
</div>

<div class="mb-0">
<div>
<input type="submit" class="btn btn-info" name="update" value="Update">
<a href="display_image.php"  class="btn btn-secondary waves-effect" >Cancel </a>


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

<!-- Right Sidebar -->
<div class="right-bar">
<div data-simplebar class="h-100">
<div class="rightbar-title d-flex align-items-center px-3 py-4">



<a href="javascript:void(0);" class="right-bar-toggle ms-auto">
<i class="mdi mdi-close noti-icon"></i>
</a>
</div>

<!-- Settings -->
<hr class="mt-0" />

<div class="p-4">
<div class="mb-2">
<img src="assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="layout-1">
</div>

<div class="form-check form-switch mb-3">
<input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>

</div>

<div class="mb-2">
<img src="assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="layout-2">
</div>
<div class="form-check form-switch mb-3">
<input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch" data-bsStyle="assets/css/bootstrap-dark.min.css" data-appStyle="assets/css/app-dark.min.css">
</div>

<div class="mb-2">
<img src="assets/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="layout-3">
</div>
<div class="form-check form-switch mb-5">
<input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch" data-appStyle="assets/css/app-rtl.min.css">
</div>


</div>

</div> <!-- end slimscroll-menu-->
</div>
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
