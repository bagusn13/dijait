<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('admin/dashboard') ?>">
        <div class="sidebar-brand-icon">
          <i class="fas fa-hand-scissors"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><b>JAIT</b>.ID</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('admin/dashboard') ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Nav Item - Data Rekening -->
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('admin/rekening') ?>">
          <i class="fas fa-fw fa-dollar-sign"></i>
          <span>Data Rekening</span></a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('admin/pesan') ?>">
          <i class="fas fa-fw fa-envelope"></i>
          <span>Pesan</span></a>
      </li>

      <!-- Nav Item - Data Transaksi -->
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('admin/transaksi') ?>">
          <i class="fas fa-fw fa-check"></i>
          <span>Transaksi</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Layanan Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#layanan" aria-expanded="true" aria-controls="layanan">
          <i class="fas fa-fw fa-chart-line"></i>
          <span>Layanan</span>
        </a>
        <div id="layanan" class="collapse" aria-labelledby="headingLayanan" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Layanan Components:</h6>
            <a class="collapse-item" href="<?php echo base_url('admin/layanan') ?>">Data Layanan</a>
            <a class="collapse-item" href="<?php echo base_url('admin/layanan/tambah') ?>">Tambah Layanan</a>
            <a class="collapse-item" href="<?php echo base_url('admin/kategori') ?>">Kategori Layanan</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pengguna Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pengguna" aria-expanded="true" aria-controls="pengguna">
          <i class="fas fa-fw fa-users-cog"></i>
          <span>Pengguna</span>
        </a>
        <div id="pengguna" class="collapse" aria-labelledby="headingPengguna" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Pengguna Components:</h6>
            <a class="collapse-item" href="<?php echo base_url('admin/user') ?>">Data Pengguna</a>
            <a class="collapse-item" href="<?php echo base_url('admin/user/tambah') ?>">Tambah Pengguna</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Konfigurasi Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#konfigurasi" aria-expanded="true" aria-controls="konfigurasi">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Konfigurasi</span>
        </a>
        <div id="konfigurasi" class="collapse" aria-labelledby="headingKonfigurasi" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Konfigurasi Components:</h6>
            <a class="collapse-item" href="<?php echo base_url('admin/konfigurasi') ?>">Konfigurasi Umum</a>
            <a class="collapse-item" href="<?php echo base_url('admin/konfigurasi/logo') ?>">Konfigurasi Logo</a>
            <a class="collapse-item" href="<?php echo base_url('admin/konfigurasi/icon') ?>">Konfigurasi Icon</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Instagram Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#instagram" aria-expanded="true" aria-controls="instagram">
          <i class="fab fa-fw fa-instagram"></i>
          <span>Instagram</span>
        </a>
        <div id="instagram" class="collapse" aria-labelledby="headingInstagram" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Instagram Components:</h6>
            <a class="collapse-item" href="<?php echo base_url('admin/berita') ?>">Data Instagram</a>
            <a class="collapse-item" href="<?php echo base_url('admin/berita/tambah') ?>">Tambah Data Instagram</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - testimoni Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#testi" aria-expanded="true" aria-controls="testi">
          <i class="fas fa-fw fa-comments"></i>
          <span>Testimoni</span>
        </a>
        <div id="testi" class="collapse" aria-labelledby="headingTesti" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Testimoni Components:</h6>
            <a class="collapse-item" href="<?php echo base_url('admin/testi') ?>">Data Testimoni</a>
            <a class="collapse-item" href="<?php echo base_url('admin/testi/tambah') ?>">Tambah Data Testimoni</a>
          </div>
        </div>
      </li>



      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->