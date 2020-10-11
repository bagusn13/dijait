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
            echo form_open(base_url('dashboard/changepassword'), 'class="leave-comment"'); ?>
            <form class="form-signin">
              <div class="form-label-group">
                <input type="password" id="inputOldPassword" name="old_password" class="form-control" placeholder="Password Lama" value="<?php echo set_value('old_password') ?>" required>
                <label for="inputOldPassword">Password Lama</label>
              </div>
              <div class="form-label-group">
                <input type="password" id="inputNewPassword" name="new_password" class="form-control" placeholder="Password Baru" value="<?php echo set_value('new_password') ?>" required>
                <label for="inputNewPassword">Password Baru</label>
              </div>
              <div class="form-label-group">
                <input type="password" id="inputConfirmNewPassword" name="confirm_new_password" class="form-control" placeholder="Ketik Ulang Password Baru" value="<?php echo set_value('confirm_new_password') ?>" required>
                <label for="inputConfirmNewPassword">Ketik Ulang Password Baru</label>
              </div>

              <button class="btn btn-lg btn-maroon btn-block text-uppercase" type="submit">Konfirmasi</button>
            </form>
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>