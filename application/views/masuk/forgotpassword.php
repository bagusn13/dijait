<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-6 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center"><?php echo $title ?></h5>
            <?php
            //display error
            echo validation_errors('<div class="alert alert-warning">', '</div>');

            //display notifikasi error login
            if ($this->session->flashdata('warning')) {
              echo '<div class="alert alert-warning">';
              echo $this->session->flashdata('warning');
              echo '</div>';
            }

            //display notifikasi sukses logout
            if ($this->session->flashdata('sukses')) {
              echo '<div class="alert alert-success">';
              echo $this->session->flashdata('sukses');
              echo '</div>';
            }

            //form open
            echo form_open(base_url('login/forgotpassword'), 'class="leave-comment"'); ?>
            <form class="form-signin">
              <div class="form-label-group">
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" value="<?php echo set_value('email') ?>" required autofocus>
                <label for="inputEmail">Email</label>
              </div>

              <button class="btn btn-lg btn-maroon btn-block text-uppercase" type="submit">Kirim ke email</button>
              <div class="mt-4 text-center">
                <a href="<?php echo base_url('login') ?>">Kembali Ke Login</a>
              </div>
            </form>
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>