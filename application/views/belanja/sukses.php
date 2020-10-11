<!-- Cart -->
<section class="bgwhite p-t-70 p-b-100">
  <div class="container">
    <!-- cart item -->
    <div class="pos-relative">
      <div class="bgwhite">

        <h1><?php echo $title ?></h1>
        <hr>
        <div class="clearfix"></div>
        <br><br>

        <?php if ($this->session->flashdata('sukses')) {
          echo '<div class="alert alert-warning">';
          echo $this->session->flashdata('sukses');
          echo '</div>';
        } ?>

        <p class="alert alert-success">
          Terimakasih, layanan yang sudah anda pesan akan segera kami proses
        </p>


      </div>
    </div>
  </div>
</section>