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

$result = mysqli_query($con,"SELECT * FROM project_image WHERE project_id='".$_GET['ID']."'");
$sql2="SELECT * FROM user_reg"; 
$result2 = $con->query($sql2);
if (isset($_POST['update'])) {
    // Update project details
    $project = $_POST['project'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $total_amount=$_POST['total_amount'];
    $amount_paid=$_POST['amount_paid'];
    $client_address=$_POST['client_address'];
    

    $success_count = 0;

    // Update project_details table
    $sql_update_project_details = "UPDATE project_details SET project='$project', start_date='$start_date', end_date='$end_date',total_amount='$total_amount',amount_paid='$amount_paid',client_address='$client_address' WHERE id='" . $_GET["ID"] . "'";
    if ($con->query($sql_update_project_details) === TRUE) {
        echo '<script>alert("Project Details Updated Successfully")</script>';
    }

    if(isset($_FILES['images'])) {
        $image_files = $_FILES['images'];

        // Loop through each uploaded image
        foreach($image_files['name'] as $key => $name) {
            $temp_name = $image_files['tmp_name'][$key];
            $image_name = basename($name);
            
            // Move uploaded image to desired directory
            $target_path = "images/" . $image_name;
            if(move_uploaded_file($temp_name, $target_path)) {
                // Insert image details into project_image table
                $sql_insert_image = "INSERT INTO project_image (project_id, images) VALUES ('" . $_GET["ID"] . "', '$target_path')";
                if($con->query($sql_insert_image) === TRUE) {
                    $success_count++; 
                }
            }
        }

        // Display alert message indicating the number of images inserted
        if($success_count > 0) {
            echo '<script>alert("' . $success_count . ' image(s) uploaded successfully")</script>';
           echo '<script>window.location.href="edit_project.php?ID=' . $_GET["ID"] . '";</script>';
        }
    }
}


if(isset($_POST['delete_image'])) {
    $image_id = $_POST['image_id'];
    
    // Assuming $con is your database connection
    $sql_delete = "DELETE FROM project_image WHERE id = '$image_id'";
    if(mysqli_query($con, $sql_delete)) {
        echo '<script>alert("Image deleted successfully");</script>';
        echo '<script>window.location.href="edit_project.php?ID=' . $_GET["ID"] . '";</script>';

        // You may also consider redirecting the user or refreshing the page here
    } else {
        echo '<script>alert("Error deleting image");</script>';
    }
}    
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

<?php

$fetch_query= mysqli_query($con,"SELECT * FROM project_details where id='" . $_GET["ID"] . "'");

$query_result =mysqli_fetch_assoc($fetch_query); ?>

<form method="POST" action="" enctype="multipart/form-data">
<div class="row mb-3">
<label for="example-text-input" class="col-sm-2 col-form-label">Project Details</label>
<div class="col-sm-10">
<input class="form-control" type="text" name="project" value="<?php echo $query_result['project'];?>" placeholder="Description" id="example-text-input">
</div>
</div>
<div class="row mb-3">
<label for="example-date-input" class="col-sm-2 col-form-label">Start Date</label>
<div class="col-sm-10">
<input class="form-control" type="date" name="start_date" value="<?php echo $query_result['start_date'];?>" id="example-date-input">
</div>
</div>
<div class="row mb-3">
<label for="example-date-input" class="col-sm-2 col-form-label">Expected End Date</label>
<div class="col-sm-10">
<input class="form-control" type="date" name="end_date" value="<?php echo $query_result['end_date'];?>" id="example-date-input">
</div>
</div>
<div class="row mb-3">
<label for="example-text-input" class="col-sm-2 col-form-label">Client Address</label>
<div class="col-sm-10">
<input class="form-control" type="text" name="client_address" value="<?php echo $query_result['client_address'];?>" placeholder="Client Address" required id="example-text-input">
</div>
</div>
<div class="row mb-3">
<label for="example-text-input" class="col-sm-2 col-form-label">Total Amount</label>
<div class="col-sm-10">
<div class="input-group mb-2">
<div class="input-group-prepend">
<div class="input-group-text">₹</div>
</div>
<input class="form-control" type="text" value="<?php echo $query_result['total_amount'];?>" name="total_amount" placeholder="Amount" required id="example-text-input">
</div>
</div></div>

<div class="row mb-3">
<label for="example-text-input" class="col-sm-2 col-form-label">Part Amount Paid</label>
<div class="col-sm-10">
<div class="input-group mb-2">
<div class="input-group-prepend">
<div class="input-group-text">₹</div>
</div>
<input class="form-control" type="text" name="amount_paid" value="<?php echo $query_result['amount_paid'];?>" placeholder="Amount" required id="example-text-input">
</div>
</div></div>

<div class="row mb-3">
 <label class="col-sm-2 col-form-label">Client Image</label>
            <div class="col-sm-10">
                <div class="input-group">
            <input type="file" class="form-control" name="images[]" id="images" multiple >
            </div>
            </div>
            </div>
 <input type="submit" value="Update"  class="btn btn-info waves-effect waves-light mb-5" name="update">

            <div class="row">
    <?php
  
    while($row = $result->fetch_assoc()) {
        $image_src = $row['images'];
        ?>
        <div class="col-lg-3">
            <div>
                <img src="<?php echo $image_src; ?>" alt="Project Image" class="rounded avatar-lg">
                <form method="POST" action="">
                    <input type="hidden" name="image_id" value="<?php echo $row['id']; ?>">
                    <div class="form-group">
                <button class="btn btn-danger btn-sm float-right mt-2 mb-2" title="delete" name="delete_image"
                        type="submit">
                     <i class="fa fa-trash"></i>
                </button>
            </div>
                    
                </form>
            </div>
        </div>
        <?php
    }
    ?>
</div>


                                            

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
