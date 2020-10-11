<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Masuk</h5>
            <?php
            //display error
            echo validation_errors('<div class="alert alert-warning">', '</div>');

            //display notifikasi error login
            if ($this->session->flashdata('warning')) {
              echo '<div class="alert alert-warning">';
              echo $this->session->flashdata('warning');
              echo '</div>';
            }

            //display notifikasi sukses
            if ($this->session->flashdata('sukses')) {
              echo '<div class="alert alert-success">';
              echo $this->session->flashdata('sukses');
              echo '</div>';
            }

            if ($this->session->flashdata('aktif')) {
              echo '<div class="alert alert-success">';
              echo $this->session->flashdata('aktif');
              echo '</div>';
            }





            //form open
            echo form_open(base_url('login'), 'class="leave-comment"'); ?>

            <form class="form-signin">
              <div class="form-label-group">
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" value="<?php echo set_value('email') ?>" required autofocus>
                <label for="inputEmail">Email</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password') ?>" required>
                <label for="inputPassword">Password</label>
              </div>

              <button class="btn btn-lg btn-maroon btn-block text-uppercase" type="submit">Masuk di sini</button>
              <!-- <hr class="my-4">
              <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fa fa-google mr-2"></i> Sign in with Google</button>
              <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fa fa-facebook-f mr-2"></i> Sign in with Facebook</button> -->
            </form>
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>