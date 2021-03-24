<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>RAMP - <?= $title; ?></title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url()?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/node_modules/fontawesome/css/all.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?= base_url()?>assets/node_modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/node_modules/summernote/dist/summernote-bs4.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/node_modules/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/node_modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/node_modules/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/node_modules/selectric/public/selectric.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/node_modules/prismjs/themes/prism.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/node_modules/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="<?= base_url()?>assets/node_modules/chocolat/dist/css/chocolat.css">

   <!-- This is data table -->
  <link rel="stylesheet" href="<?= base_url()?>assets/node_modules/datatables/DataTables-1.10.23/css/jquery.dataTables.min.css">
 

   <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url()?>assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/css/components.css">

</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?= base_url()?>assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <?= $user_now->username?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="<?= base_url()?>user/myprofile" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <a href="<?= base_url()?>user/setting" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Ganti Password
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?= base_url()?>auth/logout" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?= base_url() ?>">RAMP - APP</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url() ?>">RAMP</a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Halaman Utama</li>
              <li <?php if($menu == 'dashboard'){ echo 'class="active"'; } ?>>
                <a href="<?= base_url()?>"  class="nav-link"><i class="fas fa-home"></i><span>Beranda</span></a>
              </li>
              <li class="menu-header">Rekapitulasi Amplop</li>
              <li <?php if($menu == 'update-amplop'){ echo 'class="active"'; } ?>>
                <a href="<?= base_url()?>amplop/update"  class="nav-link"><i class="fas fa-envelope-open"></i><span>Perhitungan Amplop</span></a>
              </li>
               <li <?php if($menu == 'ampop'){ echo 'class="active"'; } ?>>
                <a href="<?= base_url()?>amplop"  class="nav-link"><i class="fas fa-list"></i><span>Data Perhitungan</span></a>
              </li>
              <li <?php if($menu == 'rekap-lingkungan'){ echo 'class="active"'; } ?>>
                <a href="<?= base_url()?>rekaplingkungan"  class="nav-link"><i class="fas fa-calculator"></i><span>Rekap Lingkungan</span></a>
              </li>
              <li <?php if($menu == 'rekap'){ echo 'class="active"'; } ?>>
                <a href="<?= base_url()?>rekap"  class="nav-link"><i class="fas fa-envelope"></i><span>Rekap Amplop Coklat</span></a>
              </li>
              <li <?php if($menu == 'kembali'){ echo 'class="active"'; } ?>>
                <a href="<?= base_url()?>penerimaan"  class="nav-link"><i class="fas fa-sign-in-alt"></i><span>Penerimaan Amplop</span></a>
              </li>
              <li class="menu-header">Grafik</li>
              <li <?php if($menu == 'grafik-perhitungan'){ echo 'class="active"'; } ?>>
                <a href="<?= base_url()?>grafik/perhitungan"  class="nav-link"><i class="fas fa-chart-bar"></i><span>Perhitungan Amplop</span></a>
              </li>
              <li <?php if($menu == 'grafik-jumlah'){ echo 'class="active"'; } ?>>
                <a href="<?= base_url()?>grafik/jumlah"  class="nav-link"><i class="fas fa-chart-bar"></i><span>Perhitungan Jumlah Amplop</span></a>
              </li>
              <li <?php if($menu == 'grafik-kembali'){ echo 'class="active"'; } ?>>
                <a href="<?= base_url()?>grafik/pengembalian"  class="nav-link"><i class="fas fa-chart-bar"></i><span>Penerimaan Amplop</span></a>
              </li>

              <!-- 
              <li <?php if($menu == 'grafik-harian'){ echo 'class="active"'; } ?>>
                <a href="<?= base_url()?>grafik/harian"  class="nav-link"><i class="fas fa-chart-bar"></i><span>Rekapitulasi Perhitungan Harian Amplop</span></a>
              </li> -->
              <?php if($user_now->role == 'master'){ ?>
              <li class="menu-header">Data Master</li>
              <li <?php if($menu == 'umat'){ echo 'class="active"'; } ?> >
                <a href="<?= base_url()?>umat"  class="nav-link "><i class="fas fa-id-card"></i><span>Data Umat</span></a>
              </li>
              <li <?php if($menu == 'lingkungan'){ echo 'class="active"'; } ?>>
                <a href="<?= base_url()?>lingkungan"  class="nav-link "><i class="fas fa-users"></i><span>Data Lingkungan</span></a>
              </li>
              <li  <?php if($menu == 'user'){ echo 'class="active"'; } ?>>
                <a href="<?= base_url()?>user"  class="nav-link"><i class="fas fa-user"></i><span>Data Pengguna</span></a>
              </li>
              <?php } ?>
            </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content" style="min-height: calc(100vh - 110px);">
        <section class="section">
          <!--  End Header.php -->