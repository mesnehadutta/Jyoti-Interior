<?php $currentPage = $currentPage ?? 'home'; ?>
<body id="body" class="cta-page-offset">
  <div id="preloader">
    <div class="preloader">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>

  <header class="navigation fixed-top">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light px-0">
        <a class="navbar-brand logo" href="index.php">
          <img loading="lazy" class="logo-default" src="asset/images/logo-2.png" width="100" height="100" alt="Jyoti Interior logo">
          <img loading="lazy" class="logo-white" src="asset/images/logo-white-1.png" width="100" height="100" alt="Jyoti Interior logo white">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
          aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navigation">
          <ul class="navbar-nav ml-auto text-center align-items-lg-center">
            <li class="nav-item <?php echo $currentPage === 'home' ? 'active' : ''; ?>">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $currentPage === 'home' ? '#about_us' : 'index.php#about_us'; ?>">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $currentPage === 'home' ? '#services-header' : 'index.php#services-header'; ?>">Services</a>
            </li>
            <li class="nav-item <?php echo $currentPage === 'portfolio' ? 'active' : ''; ?>">
              <a class="nav-link" href="portfolio.php">Portfolio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $currentPage === 'home' ? '#contact-us' : 'index.php#contact-us'; ?>">Contact</a>
            </li>
            <li class="nav-item d-flex align-items-center">
              <button class="btn btn-warning btn-sm rounded-pill shadow-sm text-dark font-weight-bold px-3 py-2 ml-lg-3"
                data-toggle="modal" data-target="#consultationModal" type="button">
                Get Free Consultation
              </button>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </header>
