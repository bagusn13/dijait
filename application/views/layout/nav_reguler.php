<!-- navbar -->
<header class="header1">
  <!-- navbar desktop -->
  <div class="container-menu-header-reg">
    <?php
    //ambil data menu dari konfigurasi
    $nav_layanan        = $this->konfigurasi_model->nav_layanan();
    $nav_layanan_mobile = $this->konfigurasi_model->nav_layanan();
    ?>

    <div class="wrap-header-reg">
      <!-- Logo -->
      <a href="<?php echo base_url() ?>" class="logo">
        <img src="<?php echo base_url('assets/upload/image/' . $site->logo) ?>" alt="<?php echo $site->namaweb ?> | <?php echo $site->tagline ?>">
      </a>
      <!-- Menu -->
      <div class="wrap_menu">
        <nav class="menu">
          <ul class="main_menu">
            <!-- beranda -->
            <li>
              <a href="<?php echo base_url() ?>">Beranda</a>
            </li>
            <!-- menu layanan -->
            <li>
              <a href="<?php echo base_url('service') ?>">Layanan</a>
              <ul class="sub_menu">
                <?php foreach ($nav_layanan as $nav_layanan) { ?>
                  <li><a href="<?php echo base_url('service/category/' . $nav_layanan->slug_kategori) ?>"><?php echo $nav_layanan->nama_kategori ?></a></li>
                <?php } ?>
              </ul>
            </li>
            <!-- tentang -->
            <li>
              <a href="<?php echo base_url('about') ?>">Tentang Kami</a>
            </li>
            <!-- kontak -->
            <li>
              <a href="<?php echo base_url('contact') ?>">Kontak</a>
            </li>
          </ul>
        </nav>
      </div>

      <!-- Header Icon -->
      <div class="header-icons">
        <?php if ($this->session->userdata('email')) { ?>
          <div class="dropdown">
            <a href="<?php echo base_url('dashboard') ?>" class="header-wrapicon1 dis-block dropdown-toggle" style="color:white" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

              <img src="<?php echo $pelanggan->foto ?>" class="header-icon1 rounded-circle" alt="<?php echo $pelanggan->nama_pelanggan ?>">&nbsp;&nbsp;
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="<?php echo base_url('dashboard') ?>">Dashboard</a>
              <a class="dropdown-item" href="<?php echo base_url('cart') ?>">Keranjang Belanja</a>
              <a class="dropdown-item" href="<?php echo base_url('dashboard/orderHistory') ?>">Riwayat Belanja</a>
              <a class="dropdown-item" href="<?php echo base_url('dashboard/profile') ?>">Profil Saya</a>
              <?php if ($pelanggan->oauth_provider == 'dijait') { ?>
                <a class="dropdown-item" href="<?php echo base_url('dashboard/changepassword') ?>">Ganti Password</a>
                <a class="dropdown-item" href="<?php echo base_url('login/logout') ?>">Logout</a>
              <?php } else { ?>
                <a class="dropdown-item" href="<?php echo base_url('login/logout') ?>">Logout</a>
              <?php } ?>
            </div>
          </div>
        <?php } else { ?>
          <a href="<?php echo base_url('login') ?>" class="header-wrapicon1 dis-block">
            <img src="<?php echo base_url() ?>assets/upload/image/icon/orang.png" class="header-icon1" alt="ICON">
          </a>
        <?php } ?>

        <span class="linedivide1"></span>

        <div class="header-wrapicon2">
          <?php
          //cek data belanja ada atau tidak
          $keranjang = $this->cart->contents();
          ?>
          <img src="<?php echo base_url() ?>assets/upload/image/icon/keranjang.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
          <span class="header-icons-noti"><?php echo count($keranjang) ?></span>

          <!-- Header cart noti -->
          <div class="header-cart header-dropdown">
            <ul class="header-cart-wrapitem">

              <?php
              // kalau ga ada data belanjaan 
              if (empty($keranjang)) {
                ?>

                <li class="header-cart-item">
                  <p class="">Keranjang Belanja Kosong</p>
                </li>

                <?php
                  //klo ada
                } else {
                  //total belanjaan
                  $total_belanja  = 'Rp. ' . number_format($this->cart->total(), '0', ',', '.');
                  //tampilkan data belanjaan
                  foreach ($keranjang as $keranjang) {
                    $id_layanan = $keranjang['id'];
                    //ambil data layanan
                    $layanannya = $this->layanan_model->detail($id_layanan);
                    ?>

                  <li class="header-cart-item">
                    <div class="header-cart-item-img">
                      <img src="<?php echo base_url('assets/upload/image/thumbs/' . $layanannya->gambar) ?>" alt="<?php echo $keranjang['name'] ?>">
                    </div>

                    <div class="header-cart-item-txt">
                      <a href="<?php echo base_url('service/detail/' . $layanannya->slug_layanan) ?>" class="header-cart-item-name">
                        <?php echo $keranjang['name'] ?>
                      </a>

                      <span class="header-cart-item-info">
                        <?php echo $keranjang['qty'] ?> x Rp. <?php echo number_format($keranjang['price'], '0', ',', '.') ?>: Rp. <?php echo number_format($keranjang['subtotal'], '0', ',', '.') ?>
                      </span>
                    </div>
                  </li>
              <?php
                } // tutup foreach keranjang
              } // tutup else
              ?>

            </ul>

            <div class="header-cart-total">
              Total: <?php if (!empty($keranjang)) {
                        echo $total_belanja;
                      } ?>
            </div>

            <div class="header-cart-buttons">
              <div class="header-cart-wrapbtn">
                <!-- Button -->
                <a href="<?php echo base_url('cart') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                  View Cart
                </a>
              </div>

              <div class="header-cart-wrapbtn">
                <!-- Button -->
                <a href="<?php echo base_url('cart/checkout') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                  Check Out
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- navbar Mobile -->
  <div class="wrap_header_mobile">
    <!-- Logo moblie -->
    <a href="<?php echo base_url() ?>" class="logo-mobile">
      <img src="<?php echo base_url('assets/upload/image/dijait_tulisan_1.png') ?>" alt="<?php echo $site->namaweb ?> | <?php echo $site->tagline ?>">
    </a>

    <!-- Button show menu -->
    <div class="btn-show-menu">
      <!-- Header Icon mobile -->
      <div class="header-icons-mobile">
        <?php if ($this->session->userdata('email')) { ?>
          <div class="dropdown">
            <a href="<?php echo base_url('dashboard') ?>" class="header-wrapicon1 dis-block dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="<?php echo $pelanggan->foto ?>" class="header-icon1 rounded-circle" alt="<?php echo $pelanggan->nama_pelanggan ?>">&nbsp;&nbsp;
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="<?php echo base_url('dashboard') ?>">Dashboard</a>
              <a class="dropdown-item" href="<?php echo base_url('cart') ?>">Keranjang Belanja</a>
              <a class="dropdown-item" href="<?php echo base_url('dashboard/orderHistory') ?>">Riwayat Belanja</a>
              <a class="dropdown-item" href="<?php echo base_url('dashboard/profile') ?>">Profil Saya</a>
              <?php if ($pelanggan->oauth_provider == 'dijait') { ?>
                <a class="dropdown-item" href="<?php echo base_url('dashboard/changepassword') ?>">Ganti Password</a>
                <a class="dropdown-item" href="<?php echo base_url('login/logout') ?>">Logout</a>
              <?php } else { ?>
                <a class="dropdown-item" href="<?php echo base_url('login/logout') ?>">Logout</a>
              <?php } ?>
            </div>
          </div>
        <?php } else { ?>
          <a href="<?php echo base_url('login') ?>" class="header-wrapicon1 dis-block">
            <img src="<?php echo base_url() ?>assets/template/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
          </a>
        <?php } ?>

        <span class="linedivide2"></span>


        <div class="header-wrapicon2">

          <?php
          //cek data belanja ada atau tidak
          $keranjang_mobile = $this->cart->contents();
          ?>
          <img src="<?php echo base_url() ?>assets/template/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
          <span class="header-icons-noti"><?php echo count(($keranjang_mobile)) ?></span>

          <!-- Header cart noti -->
          <div class="header-cart header-dropdown">
            <ul class="header-cart-wrapitem">
              <?php
              // kalau ga ada data belanjaan 
              if (empty($keranjang_mobile)) {
                ?>

                <li class="header-cart-item">
                  <p class="alert alert-maroon">Keranjang Belanja Kosong</p>
                </li>

                <?php
                  //klo ada
                } else {
                  //total belanjaan
                  $total_belanja  = 'Rp. ' . number_format($this->cart->total(), '0', ',', '.');
                  //tampilkan data belanjaan
                  foreach ($keranjang_mobile as $keranjang_mobile) {
                    $id_layanan_mobile  = $keranjang_mobile['id'];
                    $layanan_mobile     = $this->layanan_model->detail($id_layanan_mobile);
                    ?>
                  <li class="header-cart-item">
                    <div class="header-cart-item-img">
                      <img src="<?php echo base_url('assets/upload/image/thumbs/' . $layanan_mobile->gambar) ?>" alt="<?php echo $keranjang_mobile['name'] ?>">
                    </div>

                    <div class="header-cart-item-txt">
                      <a href="#" class="header-cart-item-name">
                        <?php echo $keranjang_mobile['name'] ?>
                      </a>

                      <span class="header-cart-item-info">
                        <?php echo $keranjang_mobile['qty'] ?> x Rp. <?php echo number_format($keranjang_mobile['price'], '0', ',', '.') ?>: Rp. <?php echo number_format($keranjang_mobile['subtotal'], '0', ',', '.') ?>
                      </span>
                    </div>
                  </li>
              <?php } //closing foreach
              } //closing else 
              ?>

            </ul>

            <div class="header-cart-total">
              Total: <?php if (!empty($keranjang)) {
                        echo $total_belanja;
                      } ?>
            </div>

            <div class="header-cart-buttons">
              <div class="header-cart-wrapbtn">
                <!-- Button -->
                <a href="<?php echo base_url('cart') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                  View Cart
                </a>
              </div>

              <div class="header-cart-wrapbtn">
                <!-- Button -->
                <a href="<?php echo base_url('cart/checkout') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                  Check Out
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
        <span class="hamburger-box">
          <span class="hamburger-inner"></span>
        </span>
      </div>
    </div>
  </div>

  <!-- Menu Mobile -->
  <div class="wrap-side-menu">
    <nav class="side-menu">
      <ul class="main-menu">
        <!-- <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
        <span class="topbar-child1">
          <?php echo $site->alamat ?>
        </span>
      </li> -->

        <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
          <div class="topbar-child2-mobile">
            <span class="topbar-email">
              <?php echo $site->email ?>
            </span>

            <!-- <div class="topbar-language rs1-select2">
            <select class="selection-1" name="time">
              <?php echo $site->telepon ?>
              <?php echo $site->email ?>
            </select>
          </div> -->
          </div>
        </li>

        <li class="item-topbar-mobile p-l-10">
          <div class="topbar-social-mobile">
            <a href="<?php echo $site->facebook ?>" class="topbar-social-item fa fa-facebook"></a>
            <a href="<?php echo $site->instagram ?>" class="topbar-social-item fa fa-instagram"></a>
          </div>
        </li>

        <!-- menu mobile homepage-->
        <li class="item-menu-mobile">
          <a href="<?php echo base_url() ?>">Beranda</a>
        </li>

        <!-- menu mobile layanan -->
        <li class="item-menu-mobile">
          <a href="<?php echo base_url('service') ?>">Layanan</a>
          <ul class="sub-menu">
            <?php foreach ($nav_layanan_mobile as $nav_layanan_mobile) { ?>
              <li><a href="<?php echo base_url('service/category/' . $nav_layanan_mobile->slug_kategori) ?>"><?php echo $nav_layanan_mobile->nama_kategori ?></a></li>
            <?php } ?>
          </ul>
          <i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
        </li>

        <li class="item-menu-mobile">
          <a href="<?php echo base_url('about') ?>">Tentang Kami</a>
        </li>

        <li class="item-menu-mobile">
          <a href="<?php echo base_url('contact') ?>">Kontak</a>
        </li>
      </ul>
    </nav>
  </div>
</header>