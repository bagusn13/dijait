<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0"><a href="<?php echo base_url() ?>">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">About</strong></div>
    </div>
  </div>
</div>

<section class="tentang p-t-60 p-b-50" id="aboutus">
  <div class="container">
    <div class="row">
      <div class="col-sm-7">
        <h1 class="text-center">Tentang Kami</h1>
        <p>Dijait adalah sebuah platform yang menghubungkan pelanggan dengan mitra penjahit untuk memperbaiki dan mempercantik busana pelanggan. Susahnya penjahit keliling yang mulai sulit ditemukan membuat kami untuk menciptakan sebuah platform yang dapat meneruskan pesanan penjahit kepada masyarakat.</p>
        <p>Dijait adalah sebuah platform yang menghubungkan pelanggan dengan mitra penjahit untuk memperbaiki dan mempercantik busana pelanggan. Susahnya penjahit keliling yang mulai sulit ditemukan membuat kami untuk menciptakan sebuah platform yang dapat meneruskan pesanan penjahit kepada masyarakat.</p>
      </div>
      <div class="col-sm-5">
        <div class="img-wrap-tentang">
          <img src="<?php echo base_url() ?>assets/upload/image/tentang/dijait.png" alt="">
        </div>

      </div>
    </div>
  </div>
</section>

<section class="" id="ourteam">
  <div class="p-t-60 p-b-50 ourteam site-blocks-cover-price m-b-50" style="background-image: url(<?php echo base_url('assets/home/Background_Pattern_web.png') ?>);">
    <div class="wrapper-team">
      <h1>Tim Kami</h1>
      <div class="team">
        <div class="team_member m-b-10">
          <div class="team_img">
            <img src="<?php echo base_url() ?>assets/upload/image/tentang/bagus.jpeg" alt="team_member_img">
          </div>
          <h3>Bagus Nugraha</h3>
          <p class="role">FullStack Developer</p>
        </div>

        <div class="team_member m-b-10">
          <div class="team_img">
            <img src="<?php echo base_url() ?>assets/upload/image/tentang/jidni.jpeg" alt="team_member_img">
          </div>
          <h3>Irfan Zidni</h3>
          <p class="role">CEO</p>
        </div>

        <div class="team_member m-b-10">
          <div class="team_img">
            <img src="<?php echo base_url() ?>assets/upload/image/tentang/patur.jpeg" alt="team_member_img">
          </div>
          <h3>Fathur Ikhsan</h3>
          <p class="role">Front-End Developer</p>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- testimony -->
<section class="testiwrap p-t-40 p-b-70">
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