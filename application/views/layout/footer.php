<?php
// load data konfigurasi website
$site                 = $this->konfigurasi_model->listing();
$nav_layanan_footer   = $this->konfigurasi_model->nav_layanan();
?>

<footer class="site-footer custom-border-top">
  <div class="container">
    <div class="row">
      <div class="col-lg-2"></div>
      <div class="col-md-6 mr-auto col-lg-2">
        <div class="block-5 mb-5">
          <h3 class="footer-heading mb-4">KONTAK KAMI</h3>
          <ul class="list-unstyled">
            <li class="address"><?php echo nl2br($site->alamat) ?></li>
            <li class="phone"><a href="tel://<?php echo $site->telepon ?>"><?php echo $site->telepon ?></a></li>
            <li class="email"><?php echo $site->email ?></li>
          </ul>
        </div>

        <!-- <div class="block-7">
          <form action="#" method="post">
            <label for="email_subscribe" class="footer-heading">Subscribe</label>
            <div class="form-group">
              <input type="text" class="form-control py-4" id="email_subscribe" placeholder="Email">
              <input type="submit" class="btn btn-sm btn-primary" value="Send">
            </div>
          </form>
        </div> -->
      </div>
      <div class="col-lg-6 mr-auto mb-5 mb-lg-0">
        <div class="row">
          <div class="col-md-12">
            <h3 class="footer-heading mb-4">Quick Links</h3>
          </div>
          <div class="col-md-6 col-lg-4">
            <ul class="list-unstyled">
              <li><a href="#">Beranda</a></li>
              <li><a href="#">Layanan</a></li>
              <li><a href="#">Tentang Kami</a></li>

            </ul>
          </div>
          <div class="col-md-6 col-lg-4">
            <ul class="list-unstyled">
              <li><a href="#">Kontak Kami</a></li>
              <li><a href="<?php echo $site->facebook ?>" class="fa fa-facebook"> Facebook</a></li>
              <li><a href="<?php echo $site->instagram ?>" class="fa fa-instagram"> Instagram</a></li>
            </ul>
          </div>
          <!-- <div class="col-md-6 col-lg-4">
            <ul class="list-unstyled">
              <li><a href="#">Point of sale</a></li>
              <li><a href="#">Hardware</a></li>
              <li><a href="#">Software</a></li>
            </ul>
          </div> -->
        </div>
      </div>


    </div>
    <div class="row pt-5 mt-5 text-center">
      <div class="col-md-12">
        <p>
          Copyright &copy;<script>
            document.write(new Date().getFullYear());
          </script> All rights reserved
        </p>
      </div>

    </div>
  </div>
</footer>
</div>

<script src="<?php echo base_url() ?>assets/shopmax/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url() ?>assets/shopmax/js/jquery-ui.js"></script>
<script src="<?php echo base_url() ?>assets/shopmax/js/popper.min.js"></script>
<script src="<?php echo base_url() ?>assets/shopmax/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/shopmax/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url() ?>assets/shopmax/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url() ?>assets/shopmax/js/aos.js"></script>

<script src="<?php echo base_url() ?>assets/shopmax/js/main.js"></script>

<script type="text/javascript">
  $('.block2-btn-addcart').each(function() {
    var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
    $(this).on('click', function() {
      swal(nameProduct, "is added to cart !", "success");
    });
  });


  $('.block2-btn-addwishlist').each(function() {
    var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
    $(this).on('click', function() {
      swal(nameProduct, "is added to wishlist !", "success");
    });
  });
</script>
<script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function() {
    'use strict';

    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');

      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
</script>


</body>

</html>