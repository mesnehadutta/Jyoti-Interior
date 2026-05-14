<?php
session_start();
require_once __DIR__ . '/../dbconnection.php';

if (isset($_GET['logout'])) {
    unset($_SESSION['sess_email']);
    session_destroy();
    redirect('../index.php');
}

if (empty($_SESSION['sess_email'])) {
    redirect('../index.php');
}

$email = $_SESSION['sess_email'];

$consultationStatement = $conn->query('SELECT * FROM free_consultation ORDER BY ID DESC');
$consultations = $consultationStatement->fetchAll();

$adminStatement = $conn->prepare('SELECT * FROM admin WHERE ID = :id');
$adminStatement->execute([':id' => 1]);
$result1 = $adminStatement->fetch();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../assets/img/icon10.png">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/icons.min.css" rel="stylesheet" />
  <link href="assets/css/app.min.css" rel="stylesheet" />
  <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
  <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
</head>
<body data-topbar="dark">
<div id="layout-wrapper">

<?php include('topbar.php');?>
<?php include('sidebar.php'); ?>

<div class="main-content">
  <div class="page-content">
    <div class="container-fluid">

      <div class="card">
        <div class="card-body">
          <table id="key-datatable" class="table table-bordered dt-responsive nowrap w-100">
            <thead>
              <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Message</th><th>Date</th><th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $c = 1;
              if (!empty($consultations)) {
                foreach ($consultations as $row) {
                  echo '<tr>
                    <td>' . $c . '</td>
                    <td>' . escape_html($row['name']) . '</td>
                    <td>' . escape_html($row['email']) . '</td>
                    <td>' . escape_html($row['phone']) . '</td>
                    <td>' . escape_html($row['message']) . '</td>
                    <td>' . escape_html($row['default_date']) . '</td>
                    <td><a href="delete.php?ID=' . (int) $row['ID'] . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-danger">Delete</a></td>
                  </tr>';
                  $c++;
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>

  <footer class="footer">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">Â© Deco House</div>
        <div class="col-sm-6 text-sm-end">
          Designed and Developed by <a href="https://www.pbainst.in/" class="text-danger">PBA INSTITUTE</a>
        </div>
      </div>
    </div>
  </footer>
</div>

</div>

<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="assets/js/pages/datatables.init.js"></script>
<script src="assets/js/app.js"></script>

</body>
</html>
