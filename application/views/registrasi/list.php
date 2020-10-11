<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center"><?php echo $title ?></h5>
            <?php if ($this->session->flashdata('sukses')) {
              echo '<div class="alert alert-warning">';
              echo $this->session->flashdata('sukses');
              echo '</div>';
            }
            if ($this->session->flashdata('gagal')) {
              echo '<div class="alert alert-warning">';
              echo $this->session->flashdata('gagal');
              echo '</div>';
            } ?>
            <?php
            //display error
            echo validation_errors('<div class="alert alert-warning">', '</div>');

            //form open
            echo form_open(base_url('register'), 'class="leave-comment"'); ?>
            <form class="form-signin">
              <div class="form-label-group">
                <input type="text" id="inputNama" name="nama_pelanggan" class="form-control" placeholder="Nama Lengkap" value="<?php echo set_value('nama_pelanggan') ?>" required autofocus>
                <label for="inputNama">Nama Lengkap</label>
              </div>

              <div class="form-label-group">
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email') ?>" required>
                <label for="inputEmail">Email</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password') ?>" required>
                <label for="inputPassword">Password</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="inputConfirmpassword" name="confirm_password" class="form-control" placeholder="Confirm Password" value="<?php echo set_value('confirm_password') ?>" required>
                <label for="inputConfirmpassword">Ketik ulang password</label>
              </div>

              <div class="form-label-group">
                <input type="text" id="inputTelepon" name="telepon" class="form-control" placeholder="Telepon" value="<?php echo set_value('telepon') ?>" required>
                <label for="inputTelepon">Telepon</label>
              </div>

              <div class="form-label-group">
                <input id="inputAlamat" name="alamat" class="form-control" placeholder="Alamat" value="<?php echo set_value('alamat') ?>">
                <label for="inputAlamat">Alamat</label>
              </div>

              <button class="btn btn-lg btn-maroon btn-block text-uppercase" type="submit">Daftar di sini</button>
              <div class="mt-4 text-center">
                Sudah memiliki akun? <a href="<?php echo base_url('login') ?>">Masuk di sini</a>
              </div>
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