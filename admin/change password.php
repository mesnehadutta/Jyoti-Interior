<?php
session_start();
require_once __DIR__ . '/../dbconnection.php';

$email = $_SESSION['sess_email'] ?? '';
if (isset($_GET['logout'])) {
    unset($_SESSION['sess_email']);
    session_destroy();
    redirect('../index.php');
}

if (empty($_SESSION['sess_email'])) {
    redirect('../index.php');
}

$adminStatement = $conn->prepare('SELECT * FROM admin WHERE ID = :id');
$adminStatement->execute([':id' => 1]);
$result1 = $adminStatement->fetch();

if (isset($_POST['submit'])) {
    $oldpass = (string) ($_POST['oldpwd'] ?? '');
    $newpassword = (string) ($_POST['newpwd'] ?? '');
    $confirmpasswod = (string) ($_POST['conpwd'] ?? '');
    $storedPassword = (string) ($result1['password'] ?? '');
    $trimmedStoredPassword = trim($storedPassword);

    if ($newpassword !== $confirmpasswod) {
        echo '<script>alert("New password and confirm password do not match")</script>';
    } elseif (
        !hash_equals($storedPassword, $oldpass) &&
        !hash_equals($trimmedStoredPassword, $oldpass) &&
        !password_verify($oldpass, $storedPassword) &&
        !password_verify($oldpass, $trimmedStoredPassword)
    ) {
        echo '<script>alert("Old password is incorrect")</script>';
    } else {
        $passwordToStore = password_hash($newpassword, PASSWORD_DEFAULT);
        $updateStatement = $conn->prepare('UPDATE admin SET password = :password WHERE ID = :id');
        $updateStatement->execute([
            ':password' => $passwordToStore,
            ':id' => 1,
        ]);

        echo '<script>alert("Password Changed Successfully")</script>';
        echo '<script>window.location.href = "change password.php"</script>';
        exit();
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
<link rel="shortcut icon" href="../assets/img/icon10.png">

<link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body data-topbar="dark">
<div id="layout-wrapper">


<?php include('topbar.php') ?>

<?php include('sidebar.php') ?>

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
<input type="password" class="form-control" required="" name="oldpwd" placeholder="Old Password" value="">
</div>
</div>
<div class="mb-3">
<label>New Password</label>
<div>
<input type="password" class="form-control" required="" name="newpwd" placeholder="New Password" value="">
</div>
</div>
<div class="mb-3">
<label>Confirm Password</label>
<div>
<input type="password" class="form-control" required="" name="conpwd" placeholder="Confirm Password" value="">
</div>
</div>


<div class="mb-0">
<div>
<input type="submit" class="btn btn-info" name="submit" value="Change Password">
<button type="reset" class="btn btn-secondary waves-effect">
Cancel
</button>
</div>
</div>
</form>

</div>
</div>
</div>
</div>


</div>
</div>


</div>


  <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                               Â© Deco House
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

<div class="rightbar-overlay"></div>

<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/metismenu/metisMenu.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>

<script src="assets/libs/moment/min/moment.min.js"></script>
<script src="assets/libs/bootstrap-editable/js/index.js"></script>

<script src="assets/js/pages/form-xeditable.init.js"></script>

<script src="assets/js/app.js"></script>

</body>
</html>
