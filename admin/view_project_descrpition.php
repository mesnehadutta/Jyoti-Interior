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

$sql2=mysqli_query($con,"SELECT * FROM project_details WHERE id='".$_GET["ID"]."'");
$query1=mysqli_fetch_assoc($sql2);

$sql3=mysqli_query($con,"SELECT * FROM project_description WHERE project_id='".$_GET["ID"]."'");
$query2=mysqli_fetch_assoc($sql3);
$client_id=$query1["client_id"];
$sql4=mysqli_query($con,"SELECT * FROM user_reg where ID='$client_id'");
$query3=mysqli_fetch_assoc($sql4);

// Fetch images from database
$sql = "SELECT image FROM project_description where project_id='".$_GET["ID"]."'";
$result = $con->query($sql);

$images = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $images[] = $row['image'];
    }
}

$id=$_GET['ID'];
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
               <div class="row">
        <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-6">
                        <h4 class="card-title">Project Details</h4>
                        <p class="card-title-desc"></p>
                        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                            <ol class="carousel-indicators">
                                 <?php for ($i = 0; $i < count($images); $i++) { ?>
                                <li data-bs-target="#carouselExampleFade" data-bs-slide-to="<?php echo $i; ?>" <?php if ($i == 0) echo 'class="active"'; ?>></li><?php } ?>
                                
                            </ol>
                            <div class="carousel-inner">
                                <?php foreach ($images as $key => $image) { ?>
                                <div class="carousel-item <?php if ($key == 0) echo 'active'; ?>">
                                    <img class="img-fluid" style="height:400px; width: 700px" src="images/<?php echo $image; ?>"  alt="Slide  <?php echo $key; ?>">
                                </div><?php } ?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-6">
    <div class="mt-5"></div>
    <div class="row">                      
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab">
                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                    <span class="d-none d-sm-block">View</span>    
                </a>
            </li>
            <?php
            $project_description = mysqli_query($con, "SELECT * FROM project_description WHERE project_id='" . $_GET["ID"] . "'");
            if ($project_description->num_rows > 0) {
                $index = 0;
                while ($row = $project_description->fetch_assoc()) {
                    $index++;
            ?>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab_<?php echo $index; ?>" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block">
                                <?php 
                                $date = $row['date1']; 
                                $new_date = date('d F Y', strtotime($date));
                                echo $new_date;
                                ?>
                            </span>    
                        </a>
                    </li>
            <?php } ?>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content p-3 text-muted">
            <div class="tab-pane active" id="home" role="tabpanel">
                <dl class="row mb-0">
                    <dt class="col-sm-3"><h5 class="card-title">Tittle</h5></dt>
                    <dd class="col-sm-9"><p> <?php echo $query1["project"];?></p></dd>
                    <dt class="col-sm-3"><h5 class="card-title" >Start Date</h5></dt>
                    <dd class="col-sm-9"><p> <?php echo $query1["start_date"];?></p></dd>
                    <dt class="col-sm-3"><h5 class="card-title"> End Date</h5></dt>
                    <dd class="col-sm-9"><p> <?php echo $query1["end_date"];?></p></dd>
                    <dt class="col-sm-3"><h5 class="card-title">Client Name</h5></dt>
                    <dd class="col-sm-9"><p class="font-size-15"><?php echo $query3["firstname"]." ". $query3["lastname"];?></p></dd>
                    <dt class="col-sm-3"><h5 class="card-title">Client Address</h5></dt>
                    <dd class="col-sm-9"><p class="font-size-15"><?php echo $query1["client_address"] ?></p></dd>
                </dl>
            </div>
            <?php
            $project_description->data_seek(0); // Reset pointer to the beginning of the result set
            $index = 0; // Reset index counter
            while ($row = $project_description->fetch_assoc()) {
                $index++; // Increment index for each row
            ?>
                <div class="tab-pane" id="tab_<?php echo $index; ?>" role="tabpanel">
                   <dl class="row mb-0">
                    <dt class="col-sm-4"><h5 class="card-title">Date</h5></dt>
                    <dd class="col-sm-6"><p> <?php echo $row['date1'];?></p></dd>
                    <dt class="col-sm-4"><h5 class="card-title" >Recent Work Done</h5></dt>
                    <dd class="col-sm-6"><p> <?php echo $row["work_done"];?></p></dd>
                    <dt class="col-sm-4"><h5 class="card-title">Recent Work Details</h5></dt>
                    <dd class="col-sm-6"><p> <?php echo $row["work_details"];?></p></dd>
                    <dt class="col-sm-4"><h5 class="card-title">Pending Part Amount</h5></dt>
                    <dd class="col-sm-6"><p class="font-size-15"><?php echo $row['pending_amount']?></p></dd>
                    
                </dl> 
                    
                </div>
            <?php }} ?>
        </div>
    </div>
</div>


<div class="text-right mt-3">

<button id="delete" name="DELETE" class="btn btn-danger mb-4" style="align:center">DELETE ALL DETAILS</button></div>
</div>
              </div> 

              </div>
              </div> 
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

        <script src="assets/js/app.js"></script>

    </body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#delete").click(function() {
            var id = "<?php echo $_GET['ID']; ?>"; // Get the ID from PHP
            if (confirm("Are you sure you want to delete?")) {
                $.ajax({
                    type: "POST", // Change method to POST
                    url: "delete_project_details.php", 
                    data: { ID: id }, // Pass the ID to delete
                           success: function (response) {
            //console.log(response);

            var data = JSON.parse(response);
                        alert(data.message); // Alert the message from the server
                        if (data.status === 'success') {
                            // Redirect or reload the page if needed
                            window.location.href="display_project.php";}
                    },
                });
            }
        });
    });
</script>


