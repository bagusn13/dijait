<!-- testimony -->
<section class="testiwrap">
  <div class="container">
    <div class="row testimonial">
      <div class="col-md-8 col-center m-auto">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Carousel indicators -->
          <!-- <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
          </ol> -->

          <!-- Wrapper for carousel items -->
          <div class="carousel-inner">

            <div class="item carousel-item active">
              <div class="img-box"><img src="<?php echo base_url('assets/home/vivi.jpeg') ?>" alt=""></div>
              <p class="testimonial">Pelayananya bagus banget. Saya pesen hari jumat pagi buat ketemuan ngasih celana yang mau dikecilin, dan dihari itu juga sekitar pukul 14.28 an saya dikabari bahwa celananya udah jadi. Padahal jujur saya udah berkali-kali jait karena kan badan saya kecil jadi sering ngecilin. Tapi selalu paling cepet 2 hari baru selesai. HARGANYA JUGA MURAH. Pokoknya mantep banget deh DIJAIT.ID</p>
              <p class="overview"><b>Vivi Rofiah</b>, Mahasiswa</p>
            </div>
            <?php foreach ($testi as $testi) { ?>
              <div class="item carousel-item">
                <div class="img-box"><img src="<?php echo base_url('assets/upload/image/testimoni/' . $testi->gambar) ?>" alt="<?php echo $testi->nama_pelanggan ?>"></div>
                <p class="testimonial"><?php echo $testi->testimoni ?></p>
                <p class="overview"><b><?php echo $testi->nama_pelanggan ?></b>, <?php echo $testi->pekerjaan ?></p>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- akhir testimony -->