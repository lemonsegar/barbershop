<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?= $title ?? 'Awan BarberShop' ?></title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/modules/owlcarousel2/dist/owl.carousel.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/modules/owlcarousel2/dist/owl.theme.default.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/css/components.css">

  <?= $this->renderSection('css') ?>
</head>

<body>
  <?php if (strtolower(current_url()) == strtolower(base_url('user'))): ?>
    <?php include(APPPATH . 'Views/user/modaluser.php'); ?>
  <?php endif; ?>
  <?php if (strtolower(current_url()) == strtolower(base_url('karyawan'))): ?>
    <?php include(APPPATH . 'Views/karyawan/modalkaryawan.php'); ?>
  <?php endif; ?>
  <?php if (strtolower(current_url()) == strtolower(base_url('pelanggan'))): ?>
    <?php include(APPPATH . 'Views/pelanggan/modalpelanggan.php'); ?>
  <?php endif; ?>
  <?php if (strtolower(current_url()) == strtolower(base_url('paket'))): ?>
    <?php include(APPPATH . 'Views/paket/modalpaket.php'); ?>
  <?php endif; ?>

  <?php
  $currentUrl = current_url();
  if (
    $currentUrl == base_url('booking/create') ||
    $currentUrl == base_url('booking/edit') ||
    strpos($currentUrl, base_url('booking/formedit')) !== false ||
    strpos($currentUrl, '/booking/edit/') !== false
  ): ?>
    <?php include(APPPATH . 'Views/booking/modal.php'); ?>
  <?php endif; ?>

  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <?= $this->include('layout/header') ?>

      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?= base_url() ?>">Awan BarberShop</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url() ?>">AB</a>
          </div>

          <ul class="sidebar-menu">
            <?= $this->include('layout/menu') ?>
          </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <?= $this->renderSection('isi') ?>
        </section>
      </div>

      <?= $this->include('layout/footer') ?>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="<?= base_url() ?>/assets/modules/jquery.min.js"></script>
  <script src="<?= base_url() ?>/assets/modules/popper.js"></script>
  <script src="<?= base_url() ?>/assets/modules/tooltip.js"></script>
  <script src="<?= base_url() ?>/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?= base_url() ?>/assets/modules/moment.min.js"></script>
  <script src="<?= base_url() ?>/assets/js/stisla.js"></script>

  <!-- JS Libraries -->
  <script src="<?= base_url() ?>/assets/modules/chart.min.js"></script>
  <script src="<?= base_url() ?>/assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
  <script src="<?= base_url() ?>/assets/modules/summernote/summernote-bs4.js"></script>

  <!-- Template JS File -->
  <script src="<?= base_url() ?>/assets/js/scripts.js"></script>
  <script src="<?= base_url() ?>/assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
  <?= $this->renderSection('js') ?>
</body>

</html>