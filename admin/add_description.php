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
$sql = "SELECT * FROM free_consultation";

$result = $con->query($sql);

$sql1=mysqli_query($con,"SELECT * FROM admin where ID='1'");
$result1 =mysqli_fetch_assoc($sql1);

$cid=$_GET['ID'];

?>

<!doctype html>
<html lang="en">

<head>

<meta charset="utf-8" />
<title>Add Project Description </title>
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body data-topbar="dark">

<!-- <body data-layout="horizontal" data-topbar="dark"> -->

<!-- Begin page -->
<div id="layout-wrapper">


<?php include('topbar.php') ?>


<!-- ========== Left Sidebar Start ========== -->
<?php include('sidebar.php');?>
<!-- Left Sidebar End -->




<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

<div class="page-content">
<div class="container-fluid">

<form id="mainForm" class="needs-validation" enctype="multipart/form-data">
<div class="row" id="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">
<div class="table-responsive">

<table class="table table-borderless mb-0" id="dynamic_field"> <tbody>
<?php

if($_GET['ID'] !="")
{

$product = "SELECT * FROM project_description WHERE  project_id='".$_GET['ID']."'";
$result_product = mysqli_query($con, $product);
if ($result_product->num_rows > 0) {
$i=1;
while($row_product = $result_product->fetch_assoc())
{

?>
<tr id="row<?php echo $i-1;?>" class="row_item">
<td>
<label for="validationCustom01" class="form-label">Date</label>

<input type="date" class="form-control" id="validationCustom01"  value="<?php echo $row_product['date1'];?>" name ="date[]" placeholder="Date" required>
</div></td>
<td>
<label for="validationCustom02" class="form-label">Recent Work Done</label><input  type="text" class="form-control" id="validationCustom02" value="<?php echo $row_product['work_done'];?>" name="work_done[]" required></td>
<td>
<label for="validationCustom02" class="form-label">Recent Work Details</label><input  type="text" class="form-control" id="validationCustom02" value="<?php echo $row_product['work_details'];?>" name="work_detail[]" required></td>     

<td>
<label for="validationCustom02" class="form-label">Pending Part Amount</label><input  type="text" class="form-control" id="validationCustom02" value="<?php echo $row_product['pending_amount'];?>" name="pending_amount[]" required></td>
<td>
    <label>Image</label>
<?php if(isset($row_product['image'])){?>
<input type="text" class="form-control" name="image_name[]" value="<?php echo $row_product['image_name'];?>" style="display:none;"/>
<input type="file" class="form-control" name="images[]">
<?php }
?>
</td>
<td><img width="50" height="50" class="mt-3" src="images/<?php echo $row_product['image'];?>"></td>

<?php

if($i==1)
{?> <td><button type="button" name="add" style="margin-top: 27px;" id="add" class="btn btn-success"><i class=" fa fa-plus-square"></i></button></td> 
<?php } else {?> 
<td><button type="button" name="remove" style="margin-top:27px;" id="<?php echo $i-1;?>" class="btn btn-danger btn_remove"><i class="fa fa-trash"></i></button></td>
<?php } ?>

</tr>

<?php 
$i++; } } }?>

</tbody>
</table>
</div>

</div>
</div>
</div>
</div>
</form>


</div> <!-- container-fluid -->
<div class="text-left" style="margin-left: 30px;">

<button id="submitBtn" form="mainForm" class="btn btn-primary mb-4" style="align:center">Save changes</button></div>
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

<script>
$(document).ready(function () {
    var i = <?php echo $i-2;?>;

    $('#add').click(function () {
        i++;
        $('#dynamic_field').append('<tr id="row'+i+'"  class="row_item"><td><label for="validationCustom01" class="form-label">Date</label><input type="date" class="form-control" id="validationCustom01"  value="" name ="date[]" placeholder="Date" required></div></td><td><label for="validationCustom02" class="form-label">Recent Work Done</label><input  type="text" class="form-control" id="validationCustom02" value="" name="work_done[]" required></td><td><label for="validationCustom02" class="form-label">Recent Work Details</label><input  type="text" class="form-control" id="validationCustom02" value="" name="work_detail[]" required></td><td><label for="validationCustom02" class="form-label">Pending Part Amount</label><input  type="text" class="form-control" id="validationCustom02" value="" name="pending_amount[]" required></td><td><label for="validationCustom02" class="form-label">Recent Images</label><input type="file" class="form-control" name="images[]" id="images" required></td><td><button type="button" name="remove" style="margin-top:27px;" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-trash"></i></button></td></tr>');
    });

     $(document).on('click', '.btn_remove', function(){ 
        var button_id = $(this).attr("id"); 
        //alert('Please submit changes');
        $('#row'+button_id+'').remove(); 
    });

    // Form Submission
    $("#mainForm").on('submit',function () {
        event.preventDefault();
        var valid = true;
        // $("input[type='file']").each(function() {
        //     if ($(this).val() != '') {
        //         valid = true; 
        //     }
        // });
        
        if (valid) {
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "save.php?cid=<?php echo $cid; ?>",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    if (response.status === "success") {
                        alert("Data added successfully");
                        window.location.href="display_project.php";
                    } else {
                        alert("Data not added. Error: " + response.message);
                    }
                },
                error: err => {
                    console.log(err);
                    alert("An error occured. Please check the source code and try again")
                }
            });
        } else {
            alert("Please select at least one image.");
        }
    });
});
</script>

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