<!-- Title Page -->
<section class="jumbotron jumbo-layanan flex-col-c-m" style="background-image: url(<?php echo base_url('assets/upload/image/slider/jumbo-layanan.jpg') ?>);">
  <h2 class="t-center">
    <?php echo $title ?>
  </h2>
  <!-- <p class="m-text13 t-center">
    <?php echo $site->namaweb ?> | <?php echo $site->tagline ?>
  </p> -->
</section>

<!-- Content page -->
<section class="bgwhite p-t-30 p-b-65">
  <div class="container">
    <!-- kategori -->
    <div class="lyn-list-nav-container" style="overflow: auto;">
      <ul class="lyn-list-nav-display" style="min-width: 542p;">
        <li class="current active">
          <a href="<?php echo base_url('service/category/permak') ?>">
            <img src="<?php echo base_url() ?>assets/upload/image/icon/vermak_bg.png" alt="" class="">
            <br>
            PERMAK
          </a>
        </li>
        <li>
          <a href="<?php echo base_url('service/category/potong') ?>">
            <img src="<?php echo base_url() ?>assets/upload/image/icon/potong_bg.png" alt="" class="">
            <br>
            POTONG
          </a>
        </li>
        <li>
          <a href="<?php echo base_url('service/category/robek') ?>">
            <img src="<?php echo base_url() ?>assets/upload/image/icon/robek_bg.png" alt="" class="">
            <br>
            ROBEK
          </a>
        </li>
        <li>
          <a href="<?php echo base_url('service/category/reslet') ?>">
            <img src="<?php echo base_url() ?>assets/upload/image/icon/sleting_bg.png" alt="" class="">
            <br>
            SLETING
          </a>
        </li>
        <li>
          <a href="<?php echo base_url('service/category/kancing') ?>">
            <img src="<?php echo base_url() ?>assets/upload/image/icon/kancing_bg.png" alt="" class="">
            <br>
            KANCING
          </a>
        </li>
      </ul>
    </div>
    <!-- layanan -->
    <div class="row justify-content-center">
      <div class="col-sm-12 col-md-12 col-lg-12 p-b-50">
        <!-- Product -->
        <div class="row">
          <?php foreach ($layanan as $layanan) { ?>
            <div class="col-sm-12 col-md-6 col-lg-6">
              <?php
              //form untuk memproses belanjaan
              echo form_open(base_url('cart/add'));
              //elemen yang di bawa
              echo form_hidden('id', $layanan->id_layanan);
              echo form_hidden('qty', 1);
              echo form_hidden('price', $layanan->harga);
              echo form_hidden('name', $layanan->nama_layanan);
              //elemen redirect
              echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));

              ?>
              <div class="row layanan-block">
                <div class="col-4 layanan-img ">
                  <img class="img-fluid border rounded-circle mx-auto d-block" src="<?php echo base_url('assets/upload/image/thumbs/' . $layanan->gambar) ?>" alt="<?php echo $layanan->nama_layanan ?>">
                </div>
                <div class="col-6 keterangan">
                  <h4><?php echo $layanan->nama_layanan ?></h4>
                  <p><?php echo $layanan->keterangan ?></p>
                </div>
                <div style="text-align:center;" class="col-2 add-to-cart">
                  <h6>IDR <?php echo number_format($layanan->harga, '0', ',', '.') ?></h6>

                  <!-- Button -->
                  <button type="submit" value="submit" class="btn btn-circle btn-sm">
                    <i class="fa fa-plus"></i>
                  </button>
                  <h6 class="pt-3">add to cart</h6>
                </div>
              </div>
              <?php
              //closing form
              echo form_close();
              ?>
            </div>
          <?php } ?>
        </div>

        <!-- Pagination -->
        <div class="pagination justify-content-center flex-m flex-w p-t-60 text-center">
          <?php echo $pagin; ?>
        </div>
      </div>
    </div>


  </div>
</section>