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

include("../dbconnection.php");

$sql1=mysqli_query($con,"SELECT * FROM admin where ID='1'");
$result1 =mysqli_fetch_assoc($sql1);

$project_query= "SELECT * FROM project_details JOIN user_reg ON project_details.client_id = user_reg.id
JOIN project_description ON project_description.project_id = project_details.id ";

$result_query= mysqli_query($con, "$project_query");

$result = mysqli_query($con,"SELECT * FROM project_details,user_reg WHERE project_details.client_id = user_reg.id");

//$result_query = mysqli_query($con, "SELECT * FROM project_details,project_despriction where project_details.id = project_despriction.project_id ");
//$con->close(); 
?>

<!doctype html>
<html lang="en">

<head>

<meta charset="utf-8" />
<title>Display Youtube links</title>
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

<!-- start page title -->

<div class="row">
<div class="col-12">
<div class="card">
<div class="card-body">


<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
<thead>
<tr>
<th>ID</th>
<th>PROJECT DESCRIPTION</th>
<th>START DATE</th>
<th>END DATE</th>
<th>CLIENT NAME</th>
<th>MORE DETAILS</th>
<th>ACTION</th>
</tr>
</thead>


<tbody>
<?php
if ($result->num_rows > 0)
{ 
$c=1;   
while($row = $result->fetch_assoc()) {?>

<tr>
<td><?php echo $c ?></td>
<td><?php echo $row["project"]; ?></td>
<td><?php echo $row["start_date"] ?></td>
<td><?php echo $row["end_date"] ?></td>
<td><?php echo $row ["firstname"].' '.$row["lastname"]; ?></td>
<td class="text-center"><a href="add_description.php?ID=<?php echo $row["id"]; ?>" class="btn btn-outline-secondary btn-sm edit" title="Edit">
ADD</a></td>
<td style="width: 100px" class="text-center">
<a href="edit_project.php?ID=<?php echo $row["id"]; ?>" class="btn btn-outline-secondary btn-sm edit" title="Edit">
<i class="fas fa-pencil-alt"></i></a>
<div class="btn-group btn-group-sm"><a href="view_project_descrpition.php?ID=<?php echo $row["id"];?>"  class="btn btn-primary waves-effect waves-light"><i class="fa fa-eye" aria-hidden="true"></i></a></div>
</td>

</tr>
<?php $c++; }}?>
</tbody>
</table>
</div>
</div>

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

<!-- Required datatable js -->
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="assets/libs/jszip/jszip.min.js"></script>
<script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<script src="assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>

<!-- Responsive examples -->
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="assets/js/pages/datatables.init.js"></script>

<script src="assets/js/app.js"></script>

</body>
</html>
