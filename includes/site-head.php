<?php
$pageTitle = $pageTitle ?? 'Jyoti Interior';
$pageDescription = $pageDescription ?? 'Jyoti Interior creates elegant, functional interior spaces for homes and commercial projects.';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="description" content="<?php echo htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?>">
  <link rel="shortcut icon" type="image/x-icon" href="asset/images/logo/meta-icon.jpg">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="asset/plugins/themefisher-font/style.css">
  <link rel="stylesheet" href="asset/plugins/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="asset/plugins/lightbox2/css/lightbox.min.css">
  <link rel="stylesheet" href="asset/plugins/animate/animate.css">
  <link rel="stylesheet" href="asset/plugins/slick/slick.css">
  <link rel="stylesheet" href="asset/css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php if (!empty($extraHeadContent)) { echo $extraHeadContent; } ?>
</head>
