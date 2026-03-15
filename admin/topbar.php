<header id="page-topbar">
  <div class="navbar-header d-flex justify-content-between align-items-center px-3">
    
    <!-- Logo Section -->
    <div class="navbar-brand-box d-flex align-items-center">
      <a href="../index.php" class="logo d-flex align-items-center">
        <img src="assets/images/icon.png" alt="logo-sm" height="90" width="100" class="me-2 d-lg-none d-block">
        <img src="assets/images/icon.png" alt="logo-lg" height="90" width="100" class="d-none d-lg-block d-inline-block">
      </a>
    </div>

    <!-- Profile Section -->
    <div class="dropdown d-inline-block user-dropdown">
      <button type="button" class="btn header-item waves-effect d-flex align-items-center" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="assets/images/users/av1.jpg" alt="avatar" class="rounded-circle header-profile-user me-2" height="32">
        <span class="d-none d-xl-inline-block"><?php echo $result1['name']; ?></span>
        <i class="mdi mdi-chevron-down ms-1"></i>
      </button>
      <div class="dropdown-menu dropdown-menu-end">
        <a class="dropdown-item" href="editprofile.php"><i class="ri-user-line me-1"></i> Profile</a>
        <a class="dropdown-item" href="change password.php"><i class="ri-settings-2-line me-1"></i> Change Password</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item text-danger" href="?logout=1"><i class="ri-shut-down-line me-1 text-danger"></i> Logout</a>
      </div>
    </div>

  </div>
</header>
