<?php

session_start();
$email = $_SESSION[ 'sess_email' ];
if ( isset( $_GET[ 'logout' ] ) )
 {

    unset( $_SESSION[ 'sess_email' ] );
    session_destroy();
    header( 'Location:../index.php' );
}

if ( empty( $_SESSION[ 'sess_email' ] ) )
 {
    header( 'Location:../index.php' );

}

include( '../dbconnection.php' );
$sql1 = mysqli_query( $con, "SELECT * FROM admin where ID='1'" );
$result1 = mysqli_fetch_assoc( $sql1 );

?>
<!doctype html>
<html lang = 'en'>

<head>

<meta charset = 'utf-8' />
<title>Image</title>
<meta name = 'viewport' content = 'width=device-width, initial-scale=1.0'>
<meta content = 'Premium Multipurpose Admin & Dashboard Template' name = 'description' />
<meta content = 'Themesdesign' name = 'author' />
<!-- App favicon -->
<link rel = 'shortcut icon' href = '../assets/img/icon10.png'>

<!-- DataTables -->
<link href = 'assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css' rel = 'stylesheet' type = 'text/css' />
<link href = 'assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css' rel = 'stylesheet' type = 'text/css' />
<link href = 'assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css' rel = 'stylesheet' type = 'text/css' />

<!-- Responsive datatable examples -->
<link href = 'assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css' rel = 'stylesheet' type = 'text/css' />

<!-- Bootstrap Css -->
<link href = 'assets/css/bootstrap.min.css' id = 'bootstrap-style' rel = 'stylesheet' type = 'text/css' />
<!-- Icons Css -->
<link href = 'assets/css/icons.min.css' rel = 'stylesheet' type = 'text/css' />
<!-- App Css-->
<link href = 'assets/css/app.min.css' id = 'app-style' rel = 'stylesheet' type = 'text/css' />

</head>

<body data-topbar = 'dark'>
<div id = 'layout-wrapper'>

<?php include('topbar.php') ?>

<!-- ========== Left Sidebar Start ========== -->
<?php include('sidebar.php') ?>
<!-- Left Sidebar End -->

<!-- ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  == -->
<!-- Start right Content here -->
<!-- ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  == -->
<div class = 'main-content'>

<div class = 'page-content'>
<div class = 'container-fluid'>

<div class = 'row'>
<div class = 'col-12'>
<div class = 'card'>
<div class = 'card-body'>

<form  action = 'add_image1.php' method = 'POST' enctype = 'multipart/form-data'>
<div class = 'row mb-3'>

<label for = 'example-text-input' class = 'col-sm-2 col-form-label'> Name </label>
<div class = 'col-sm-10'>
<input class = 'form-control' name = 'name' type = 'text' placeholder = 'Name' id = 'name'>
</div>
</div>
<!-- end row -->
<div class = 'row mb-3'>
<label for = 'example-text-input' class = 'col-sm-2 col-form-label'> Image Description </label>
<div class = 'col-sm-10'>
<input class = 'form-control' required name = 'description' type = 'text' placeholder = 'Image Description' id = 'description'>
</div>
</div>
<div class = 'row mb-3'>
<label for = 'example-search-input' class = 'col-sm-2 col-form-label'>Image</label>
<div class = 'col-sm-10'>
<div class = 'input-group'>
<input type = 'file' class = 'form-control' name = 'image' id = 'image'>
</div>
</div>
</div>
<!-- end row -->
<input type = 'submit' value = 'Upload' class = 'btn btn-info waves-effect waves-light' name = 'upload'>

<!-- end row -->
</form>
</div>
</div>

</div> <!-- end col -->

</div>
<!-- end row -->
</div>
<!-- End Page-content -->

<footer class = 'footer'>
<div class = 'container-fluid'>
<div class = 'row'>
<div class = 'col-sm-6'>
© Deco House
</div>
<div class = 'col-sm-6'>
<div class = 'text-sm-end d-none d-sm-block'>
Designed and Developed  <i class = 'mdi mdi-heart text-danger'></i>  by <a href = 'https://portfoliosnehad.netlify.app/' class = 'text-danger'>Sneha Dutta</a>
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
<div class = 'right-bar'>
<div data-simplebar class = 'h-100'>
<div class = 'rightbar-title d-flex align-items-center px-3 py-4'>

<h5 class = 'm-0 me-2'>Settings</h5>

<a href = 'javascript:void(0);' class = 'right-bar-toggle ms-auto'>
<i class = 'mdi mdi-close noti-icon'></i>
</a>
</div>

<!-- Settings -->
<hr class = 'mt-0' />
<h6 class = 'text-center mb-0'>Choose Layouts</h6>

<div class = 'p-4'>
<div class = 'mb-2'>
<img src = 'assets/images/layouts/layout-1.jpg' class = 'img-fluid img-thumbnail' alt = 'layout-1'>
</div>

<div class = 'form-check form-switch mb-3'>
<input class = 'form-check-input theme-choice' type = 'checkbox' id = 'light-mode-switch' checked>
<label class = 'form-check-label' for = 'light-mode-switch'>Light Mode</label>
</div>

<div class = 'mb-2'>
<img src = 'assets/images/layouts/layout-2.jpg' class = 'img-fluid img-thumbnail' alt = 'layout-2'>
</div>
<div class = 'form-check form-switch mb-3'>
<input class = 'form-check-input theme-choice' type = 'checkbox' id = 'dark-mode-switch' data-bsStyle = 'assets/css/bootstrap-dark.min.css' data-appStyle = 'assets/css/app-dark.min.css'>
<label class = 'form-check-label' for = 'dark-mode-switch'>Dark Mode</label>
</div>

<div class = 'mb-2'>
<img src = 'assets/images/layouts/layout-3.jpg' class = 'img-fluid img-thumbnail' alt = 'layout-3'>
</div>
<div class = 'form-check form-switch mb-5'>
<input class = 'form-check-input theme-choice' type = 'checkbox' id = 'rtl-mode-switch' data-appStyle = 'assets/css/app-rtl.min.css'>
<label class = 'form-check-label' for = 'rtl-mode-switch'>RTL Mode</label>
</div>

</div>

</div> <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class = 'rightbar-overlay'></div>

<!-- JAVASCRIPT -->
<script src = 'assets/libs/jquery/jquery.min.js'></script>
<script src = 'assets/libs/bootstrap/js/bootstrap.bundle.min.js'></script>
<script src = 'assets/libs/metismenu/metisMenu.min.js'></script>
<script src = 'assets/libs/simplebar/simplebar.min.js'></script>
<script src = 'assets/libs/node-waves/waves.min.js'></script>

<!-- bs custom file input plugin -->
<script src = 'assets/libs/bs-custom-file-input/bs-custom-file-input.min.js'></script>

<script src = 'assets/js/pages/form-element.init.js'></script>

<script src = 'assets/js/app.js'></script>

</body>
</html>
