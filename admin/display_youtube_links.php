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

$result = mysqli_query($con, "SELECT * FROM you_tube_links");

$con->close(); 
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
            <th>LINK</th>
            <th>LINK DESCRIPTION</th>
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
            <td><?php echo $row["link"] ?></td>
            <td><?php echo $row["description"] ?></td>
            <td> <a href="edit_youtube.php?ID=<?php echo $row["ID"]; ?> " onclick="return confirm('Are you sure you want to edit?')" class="btn btn-info">EDIT</a>
                <a href="delete_youtube_links.php?ID=<?php echo $row["ID"];?>" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">DELETE</a></td>
               
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

<!-- Right Sidebar -->
<div class="right-bar">
<div data-simplebar class="h-100">
<div class="rightbar-title d-flex align-items-center px-3 py-4">

<h5 class="m-0 me-2">Settings</h5>

<a href="javascript:void(0);" class="right-bar-toggle ms-auto">
<i class="mdi mdi-close noti-icon"></i>
</a>
</div>

<!-- Settings -->
<hr class="mt-0" />
<h6 class="text-center mb-0">Choose Layouts</h6>

<div class="p-4">
<div class="mb-2">
<img src="assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="layout-1">
</div>

<div class="form-check form-switch mb-3">
<input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
<label class="form-check-label" for="light-mode-switch">Light Mode</label>
</div>

<div class="mb-2">
<img src="assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="layout-2">
</div>
<div class="form-check form-switch mb-3">
<input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch" data-bsStyle="assets/css/bootstrap-dark.min.css" data-appStyle="assets/css/app-dark.min.css">
<label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
</div>

<div class="mb-2">
<img src="assets/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="layout-3">
</div>
<div class="form-check form-switch mb-5">
<input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch" data-appStyle="assets/css/app-rtl.min.css">
<label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
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
