<!-- Banner2 -->
<!-- <section class="banner2 bg5 p-t-55 p-b-55">
  <div class="container">
    <div class="row">
      <div class="col-sm-10 col-md-8 col-lg-6 m-l-r-auto p-t-15 p-b-15">
        <div class="hov-img-zoom pos-relative">
          <img src="<?php echo base_url() ?>assets/template/images/banner-08.jpg" alt="IMG-BANNER">

          <div class="ab-t-l sizefull flex-col-c-m p-l-15 p-r-15">
            <span class="m-text9 p-t-45 fs-20-sm">
              The Beauty
            </span>

            <h3 class="l-text1 fs-35-sm">
              Lookbook
            </h3>

            <a href="#" class="s-text4 hov2 p-t-20 ">
              View Collection
            </a>
          </div>
        </div>
      </div>

      <div class="col-sm-10 col-md-8 col-lg-6 m-l-r-auto p-t-15 p-b-15">
        <div class="bgwhite hov-img-zoom pos-relative p-b-20per-ssm">
          <img src="<?php echo base_url() ?>assets/template/images/shop-item-09.jpg" alt="IMG-BANNER">

          <div class="ab-t-l sizefull flex-col-c-b p-l-15 p-r-15 p-b-20">
            <div class="t-center">
              <a href="product-detail.html" class="dis-block s-text3 p-b-5">
                Gafas sol Hawkers one
              </a>

              <span class="block2-oldprice m-text7 p-r-5">
                $29.50
              </span>

              <span class="block2-newprice m-text8">
                $15.90
              </span>
            </div>

            <div class="flex-c-m p-t-44 p-t-30-xl">
              <div class="flex-col-c-m size3 bo1 m-l-5 m-r-5">
                <span class="m-text10 p-b-1 days">
                  69
                </span>

                <span class="s-text5">
                  days
                </span>
              </div>

              <div class="flex-col-c-m size3 bo1 m-l-5 m-r-5">
                <span class="m-text10 p-b-1 hours">
                  04
                </span>

                <span class="s-text5">
                  hrs
                </span>
              </div>

              <div class="flex-col-c-m size3 bo1 m-l-5 m-r-5">
                <span class="m-text10 p-b-1 minutes">
                  32
                </span>

                <span class="s-text5">
                  mins
                </span>
              </div>

              <div class="flex-col-c-m size3 bo1 m-l-5 m-r-5">
                <span class="m-text10 p-b-1 seconds">
                  05
                </span>

                <span class="s-text5">
                  secs
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> -->


<!-- Instagram -->
<section class="instagram p-t-50 p-b-50">
  <div class="sec-title p-b-52 p-l-15 p-r-15">
    <h3 class="t-center">
      @ Follow kami di Instagram
    </h3>
  </div>
  <div class="flex-w">
    <?php foreach ($berita as $berita) { ?>
      <!-- Block4 -->
      <div class="block4 wrap-pic-w">
        <img src="<?php echo base_url('assets/upload/image/instagram/' . $berita->gambar) ?>" alt="<?php echo $berita->judul_berita ?>">

        <a href="<?php echo $berita->link ?>" class="block4-overlay sizefull ab-t-l trans-0-4">
          <div class="block4-overlay-txt trans-0-4 p-l-40 p-r-25 p-b-30">
            <p class="s-text1 m-b-15 h-size1 of-hidden">
              <?php echo $berita->keterangan ?>
            </p>

            <span class="s-text1">
              Photo by @dijait.id
            </span>
          </div>
        </a>
      </div>
    <?php } ?>
  </div>
</section>