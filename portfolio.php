<?php
  include 'dbconnection.php'; // your DB connection

  // Fetch all images from DB, assuming table `image` with fields `image_url`, `name`
  $sql = "SELECT name,image FROM image ORDER BY id DESC";
  $result = $con->query($sql);

  // Prepare image array grouped by name (category)
  $imagesByCategory = [];
  while ($row = $result->fetch_assoc()) {
    $category = strtolower(str_replace(' ', '-', $row['name'])); // normalize category key
    $imagesByCategory[$category][] = $row['image'];
  }
?>


<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en">
<head>
    <style>
    .catalogue-card {
      width: 100%;
      height: 250px;
      overflow: hidden;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .catalogue-card img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .category-btn {
      margin: 0 5px 15px 0;
    }
  </style>

  <!-- Basic Page Needs
  ================================================== -->
  <meta charset="utf-8">
  <title>Jyoti Interior</title>

  <!-- Mobile Specific Metas
  ================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="One page parallax responsive HTML Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Themefisher">
  <meta name="generator" content="Themefisher Bingo HTML Template v1.0">

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="asset/images/logo/meta-icon.jpg" />

  <!-- CSS
  ================================================== -->
  <!-- Themefisher Icon font -->
  <link rel="stylesheet" href="asset/plugins/themefisher-font/style.css">
  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="asset/plugins/bootstrap/bootstrap.min.css">
  <!-- Lightbox.min css -->
  <link rel="stylesheet" href="asset/plugins/lightbox2/css/lightbox.min.css">
  <!-- animation css -->
  <link rel="stylesheet" href="asset/plugins/animate/animate.css">
  <!-- Slick Carousel -->
  <link rel="stylesheet" href="asset/plugins/slick/slick.css">
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="asset/css/style.css">

  <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS Bundle (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</head>
<body id="body">

  <!--
  Start Preloader
  ==================================== -->
  <div id="preloader">
    <div class='preloader'>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <!--
  End Preloader
  ==================================== -->

<!--
Fixed Navigation
==================================== -->
<header class="navigation fixed-top">
		<div class="container">
			<!-- main nav -->
			<nav class="navbar navbar-expand-lg navbar-light px-0">
				<!-- logo -->
				<a class="navbar-brand logo" href="index.html">
					<img loading="lazy" class="logo-default" src="asset/images/logo-2.png" width="100px" height="100px"
						alt="logo" />
					<img loading="lazy" class="logo-white" src="asset/images/logo-white-1.png" width="100px"
						height="100px" alt="logo" />
				</a>
				<!-- /logo -->
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
					aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navigation">
					<ul class="navbar-nav ml-auto text-center">
						<li class="nav-item dropdown active">
							<a class="nav-link dropdown-toggle" href="#!" id="navbarDropdown" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Homepage
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="index.php#about_us">About Us</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="index.php#services-header">Services</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="portfolio.php">Portfolio</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="index.php#contact-us">Contact</a>
						</li>
					<li class="nav-item d-flex align-items-center">
						<button class="btn btn-warning btn-sm rounded-pill shadow-sm text-dark font-weight-bold px-3 py-2 ml-lg-3"
							data-toggle="modal" data-target="#consultationModal">
							Get Free Consultation
						</button>
					</li>
					</ul>
				</div>

			</nav>
			<!-- /main nav -->
		</div>
	</header>
<!--
End Fixed Navigation
==================================== -->

<section class="single-page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Catalogue</h2>
				<ol class="breadcrumb header-bradcrumb justify-content-center">
					<li class="breadcrumb-item"><a href="index.html" class="text-white">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Portfolio</li>
				</ol>
			</div>
		</div>
	</div>
</section>

<!-- Start Portfolio Section
		=========================================== -->

<div class="container">

 <?php
  $categorySql = "SELECT DISTINCT name FROM image ORDER BY name ASC";
  $catResult = $con->query($categorySql);
?>

<div class="text-center my-4">
  <?php while ($cat = $catResult->fetch_assoc()) {
    $slug = strtolower(str_replace(' ', '-', $cat['name']));
  ?>
    <button class="btn btn-outline-primary m-1" onclick="filterCategory('<?php echo $slug; ?>')">
      <?php echo $cat['name']; ?>
    </button>
  <?php } ?>
  <button class="btn btn-outline-dark m-1" onclick="filterCategory('all')">All</button>
</div>

  <!-- Image Grid -->
  <div class="row g-4" id="image-container"></div>

  <!-- Pagination -->
  <nav class="m-5">
    <ul class="pagination justify-content-center" id="pagination"></ul>
  </nav>
</div>
<!-- Start Testimonial
=========================================== -->
		
<section class="testimonial section" id="testimonial">
  <div class="container">
    <div class="row text-center mb-4">
      <div class="col-lg-12">
        <h2 class="section-title custom-heading">What Our Customers Say</h2>
      </div>
    </div>

    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">

        <!-- Slide 1 -->
        <div class="carousel-item active">
          <div class="d-flex flex-column align-items-center p-4 shadow-sm rounded bg-light text-center">
            <img src="asset/images/company/Profile-Transparent.png" class="rounded-circle mb-3 img-fluid"
              style="width: 80px; height: 80px; object-fit: cover;" alt="Client">
            <p class="mb-3 fst-italic">
              "Exceptional service and impeccable design expertise define Jyoti Interior, led by the talented Avadesh Pandey. From conceptualization to execution, Avadesh's keen eye for detail and innovative approach truly transform spaces into works of art. His vast knowledge of interior design trends and materials ensures every project reflects both elegance and functionality. With Avadesh at the helm, Jyoti Interior delivers nothing short of excellence, making them my top choice for all interior design needs."
            </p>
            <h5 class="mb-0 fw-bold">Rohan Upadhyay</h5>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
          <div class="d-flex flex-column align-items-center p-4 shadow-sm rounded bg-light text-center">
            <img src="asset/images/company/Profile-Transparent.png" class="rounded-circle mb-3 img-fluid"
              style="width: 80px; height: 80px; object-fit: cover;" alt="Client">
            <p class="mb-3 fst-italic">"Great work! Used Branded Greenpanel HDF boards and job quality up to the mark."</p>
            <h5 class="mb-0 fw-bold">Sam Wilsone</h5>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item">
          <div class="d-flex flex-column align-items-center p-4 shadow-sm rounded bg-light text-center">
            <img src="asset/images/company/Profile-Transparent.png" class="rounded-circle mb-3 img-fluid"
              style="width: 80px; height: 80px; object-fit: cover;" alt="Client">
            <p class="mb-3 fst-italic">"Great experience working with Jyoti Interiors. Super professional, knowledgeable, and work was done quickly. Highly recommend!"</p>
            <h5 class="mb-0 fw-bold">Chandan Ghosh</h5>
          </div>
        </div>

        <!-- Slide 4 -->
        <div class="carousel-item">
          <div class="d-flex flex-column align-items-center p-4 shadow-sm rounded bg-light text-center">
            <img src="asset/images/company/Profile-Transparent.png" class="rounded-circle mb-3 img-fluid"
              style="width: 80px; height: 80px; object-fit: cover;" alt="Client">
            <p class="mb-3 fst-italic">"Great interior designer point of Howrah."</p>
            <h5 class="mb-0 fw-bold">Ramchandra Khara</h5>
          </div>
        </div>

        <!-- Slide 5 -->
        <div class="carousel-item">
          <div class="d-flex flex-column align-items-center p-4 shadow-sm rounded bg-light text-center">
            <img src="asset/images/company/Profile-Transparent.png" class="rounded-circle mb-3 img-fluid"
              style="width: 80px; height: 80px; object-fit: cover;" alt="Client">
            <p class="mb-3 fst-italic">"Truly professional craftsmanship. Value for money."</p>
            <h5 class="mb-0 fw-bold">Rohit Upadhyay</h5>
          </div>
        </div>

      </div> <!-- .carousel-inner end -->

      <!-- Controls -->
      <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  </div>
</section>




<footer id="footer" class="bg-one">
		<div class="top-footer">
			<div class="container">
				<div class="row justify-content-around">
					<div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
						<h3>about</h3>
						<p>Design is a journey, not a destination.
							Join us again as we shape beautiful spaces.</p>
					</div>
					<!-- End of .col-sm-3 -->


					<!-- End of .col-sm-3 -->

					<div class="col-lg-2 col-md-6 mb-5 mb-md-0">
						<ul>
							<li>
								<h3>Quick Links</h3>
							</li>
							<li><a href="index.php#about_us">About</a></li>
							<li><a href="index.php#services-header">Services</a></li>
							<li><a href="admin/index.php">Admin Login</a></li>
						</ul>
					</div>
					<!-- End of .col-sm-3 -->

					<div class="col-lg-3 col-md-6">
						<ul>
							<li>
								<h3>Connect with us Socially</h3>
							</li>
							<li><a
									href="https://www.facebook.com/jyoti.interiors.9?rdid=YKT43ti95Ps4mlSk&share_url=https%3A%2F%2Fwww.facebook.com%2Fshare%2F1CnKjhNZc8%2F#">Facebook</a>
							</li>
						</ul>
					</div>
					<!-- End of .col-sm-3 -->

				</div>
			</div> <!-- end container -->
		</div>
		<div class="footer-bottom">
			<h5>&copy; <span id="year"></span>. All rights reserved.</h5>
			<h6>Designed and Developed by Sneha Dutta</h6>
		</div>
	</footer> <!-- end footer -->


<!-- end Footer Area
========================================== -->
<!-- 
    Essential Scripts
    =====================================-->
<!-- Main jQuery -->
<script src="asset/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap4 -->
<script src="asset/plugins/bootstrap/bootstrap.min.js"></script>
<!-- Parallax -->
<script src="asset/plugins/parallax/jquery.parallax-1.1.3.js"></script>
<!-- lightbox -->
<script src="asset/plugins/lightbox2/js/lightbox.min.js"></script>
<!-- Owl Carousel -->
<script src="asset/plugins/slick/slick.min.js"></script>
<!-- filter -->
<script src="asset/plugins/filterizr/jquery.filterizr.min.js"></script>
<!-- Smooth Scroll js -->
<script src="asset/plugins/smooth-scroll/smooth-scroll.min.js"></script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU"></script>
<script src="asset/plugins/google-map/gmap.js"></script>

<!-- Custom js -->
<script src="asset/js/script.js"></script>

<script>
  // JS version of PHP array
  const images = <?php echo json_encode($imagesByCategory); ?>;

  let currentCategory = 'all';
  let currentPage = 1;
  const perPage = 9;

  function getCurrentImages() {
    if (currentCategory === 'all') {
      return Object.values(images).flat();
    } else {
      return images[currentCategory] || [];
    }
  }

  function renderImages() {
    const allImages = getCurrentImages();
    const start = (currentPage - 1) * perPage;
    const end = start + perPage;
    const pageImages = allImages.slice(start, end);

    const container = document.getElementById("image-container");
    container.innerHTML = '';

    pageImages.forEach(src => {
      const col = document.createElement("div");
      col.className = "col-md-4 mb-4";
      col.innerHTML = `
        <div class="catalogue-card">
          <img src="admin/images/${src}" alt="Interior Image" class="img-fluid border shadow" style="aspect-ratio: 1/1; object-fit: cover;" />
        </div>
      `;
      container.appendChild(col);
    });

    renderPagination(allImages.length);
  }

  function renderPagination(totalItems) {
    const totalPages = Math.ceil(totalItems / perPage);
    const pagination = document.getElementById("pagination");
    pagination.innerHTML = '';

    for (let i = 1; i <= totalPages; i++) {
      const li = document.createElement("li");
      li.className = `page-item ${i === currentPage ? 'active' : ''}`;
      li.innerHTML = `<a class="page-link" href="#" onclick="goToPage(${i})">${i}</a>`;
      pagination.appendChild(li);
    }
  }

  function goToPage(page) {
    currentPage = page;
    renderImages();
  }

  function filterCategory(category) {
    currentCategory = category;
    currentPage = 1;
    renderImages();
  }

  // Initial Render
  renderImages();
</script>

</body>

</html>