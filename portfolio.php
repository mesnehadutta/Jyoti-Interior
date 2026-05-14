<?php
require_once __DIR__ . '/dbconnection.php';

$imagesByCategory = [];
$imageStatement = $conn->query('SELECT name, image FROM image ORDER BY id DESC');

foreach ($imageStatement->fetchAll() as $row) {
    $category = normalize_catalogue_category($row['name']);
    $imagesByCategory[$category][] = $row['image'];
}
?>
<?php
$pageTitle = 'Jyoti Interior Portfolio';
$pageDescription = 'Browse Jyoti Interior portfolio work across residential, commercial, and modular kitchen projects.';
$currentPage = 'portfolio';
include __DIR__ . '/includes/site-head.php';
include __DIR__ . '/includes/site-header.php';
?>

<section class="single-page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Catalogue</h2>
				<ol class="breadcrumb header-bradcrumb justify-content-center">
					<li class="breadcrumb-item"><a href="index.php" class="text-white">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Portfolio</li>
				</ol>
			</div>
		</div>
	</div>
</section>

<?php include __DIR__ . '/includes/mobile-cta.php'; ?>

<!-- Start Portfolio Section
		=========================================== -->

<div class="container">

<?php
$categoryStatement = $conn->query('SELECT DISTINCT name FROM image ORDER BY name ASC');
$categories = $categoryStatement->fetchAll();
?>

<div class="text-center catalogue-toolbar">
  <?php foreach ($categories as $cat) {
    $slug = normalize_catalogue_category($cat['name']);
  ?>
    <button class="btn btn-outline-primary m-1" onclick="filterCategory('<?php echo escape_html($slug); ?>')">
      <?php echo escape_html($cat['name']); ?>
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




<?php include __DIR__ . '/includes/site-footer.php'; ?>
<?php include __DIR__ . '/includes/consultation-modal.php'; ?>
<?php
$extraScripts = str_replace(
  '__IMAGES_JSON__',
  json_encode($imagesByCategory, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
  <<<'HTML'
<script>
  // JS version of PHP array
  const images = __IMAGES_JSON__;

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
      col.className = "col-6 col-lg-4 mb-4";
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
HTML
);
include __DIR__ . '/includes/site-scripts.php';
?>
