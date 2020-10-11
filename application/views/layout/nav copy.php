<div class="site-wrap">


  <div class="header1 site-navbar bg-white py-2">
    <?php
    //ambil data menu dari konfigurasi
    $nav_layanan        = $this->konfigurasi_model->nav_layanan();
    $nav_layanan_mobile = $this->konfigurasi_model->nav_layanan();
    ?>


    <div class="container">
      <div class="d-flex align-items-center justify-content-between">
        <div class="logo">
          <div class="site-logo">
            <a href="<?php echo base_url() ?>" class="js-logo-clone">
              dijait
            </a>
          </div>
        </div>

        <div class="main-nav d-none d-lg-block">
          <nav class="site-navigation text-right text-md-center" role="navigation">
            <ul class="site-menu js-clone-nav d-none d-lg-block">
              <li>
                <a href="<?php echo base_url() ?>">Beranda</a>
              </li>
              <li class="has-children active">
                <a href="<?php echo base_url('service') ?>">Layanan</a>
                <ul class="dropdown">
                  <?php foreach ($nav_layanan as $nav_layanan) { ?>
                    <li>
                      <a href="<?php echo base_url('service/category/' . $nav_layanan->slug_kategori) ?>"><?php echo $nav_layanan->nama_kategori ?></a>
                    </li>
                  <?php } ?>
                </ul>
              </li>
              <li>
                <a href="<?php echo base_url('about') ?>">Tentang Kami</a>
              </li>
              <li>
                <a href="<?php echo base_url('contact') ?>">Kontak</a>
              </li>
            </ul>
          </nav>
        </div>

        <!-- Header Icon -->
        <div class="header-icons">

          <?php if ($this->session->userdata('email')) { ?>
            <!-- <div class="dropdown">
              <button class="header-wrapicon2 dis-block dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" style="color:white" aria-haspopup="true" aria-expanded="false">
                <img src="<?php echo $pelanggan->foto ?>" class="header-icon1 rounded-circle" alt="<?php echo $pelanggan->nama_pelanggan ?>">&nbsp;&nbsp;
              </button>

              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
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
            </div> -->
            <ul class="icons-menu">
              <li class="has-children active">
                <a disabled><?php echo $pelanggan->nama_pelanggan ?></a>
                <ul class="dropdown">
                  <li>
                    <a href="<?php echo base_url('dashboard') ?>">Dashboard</a>
                  </li>
                  <li>
                    <a href="<?php echo base_url('cart') ?>">Keranjang Belanja</a>
                  </li>
                  <li>
                    <a href="<?php echo base_url('dashboard/orderHistory') ?>">Riwayat Belanja</a>
                  </li>
                  <li>
                    <a href="<?php echo base_url('dashboard/profile') ?>">Profil Saya</a>
                  </li>

                  <?php if ($pelanggan->oauth_provider == 'dijait') { ?>
                    <li>
                      <a href="<?php echo base_url('dashboard/changepassword') ?>">Ganti Password</a>
                    </li>
                    <li>
                      <a href="<?php echo base_url('login/logout') ?>">Logout</a>
                    </li>
                  <?php } else { ?>
                    <li>
                      <a href="<?php echo base_url('login/logout') ?>">Logout</a>
                    </li>
                  <?php } ?>
                </ul>
              </li>
            </ul>


          <?php } else { ?>
            <a href="<?php echo base_url('login') ?>" class="header-wrapicon2 dis-block">
              <img src="<?php echo base_url() ?>assets/shopmax/images/keyhole2.png" class="header-icon1" alt="ICON">
            </a>
          <?php } ?>

          <span class="linedivide1"></span>

          <div class="header-wrapicon2">
            <?php
            // cek data belanja ada atau tidak
            $keranjang = $this->cart->contents();
            ?>
            <a href="<?php echo base_url('cart') ?>"><img src="<?php echo base_url() ?>assets/shopmax/images/shopbag.png" class="header-icon1" alt="cart"></a>
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
                  // klo ada
                } else {
                  // total belanjaan
                  $total_belanja  = 'Rp. ' . number_format($this->cart->total(), '0', ',', '.');
                  // tampilkan data belanjaan
                  foreach ($keranjang as $keranjang) {
                    $id_layanan = $keranjang['id'];
                    // ambil data layanan
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
                  <?php if (count($keranjang) == null) { ?>
                    <a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4 disabled" aria-disabled="true">
                      Check Out
                    </a>
                  <?php } else { ?>
                    <a href="<?php echo base_url('cart/checkout') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                      Check Out
                    </a>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>



          <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span class="icon-menu"></span></a>
        </div>

      </div>
    </div>
  </div>