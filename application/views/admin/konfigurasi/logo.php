<div class="container">
  <h1>
    <?php echo $title ?>
  </h1>
  <br>
  <?php
  // Notifikasi
  if ($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-success">';
    echo $this->session->flashdata('sukses');
    echo '</div>';
  }
  ?>

  <?php
  // Error upload
  if (isset($error)) {
    echo '<p class="alert alert-warning">';
    echo $error;
    echo '</p>';
  }

  // Notifikasi error
  echo validation_errors('<div class="alert alert-warning">', '</div>');

  //form open
  echo form_open_multipart(base_url('admin/konfigurasi/logo'), ' class="form-horizontal"');
  ?>

  <div class="form-group">
    <label class="col-form-label">Nama Website</label>
    <input type="text" name="namaweb" class="form-control" placeholder="Nama Website" value="<?php echo $konfigurasi->namaweb ?>" required>
  </div>

  <div class="form-group">
    <label class="col-form-label">Upload Logo Baru</label>
    <input type="file" name="logo" class="form-control-file" placeholder="Upload Logo Baru" value="<?php echo $konfigurasi->logo ?>" required>
    Logo lama: <br><img src="<?php echo base_url('assets/upload/image/' . $konfigurasi->logo) ?>" class="img img-responsive img-thumbnail" width="200">
  </div>

  <div class="form-group">
    <label class="col-form-label"></label>
    <button class="btn btn-success btn-lg" name="submit" type="submit">
      <i class="fa fa-save"></i> Simpan
    </button>
    <button class="btn btn-info btn-lg" name="reset" type="reset">
      <i class="fa fa-times"></i> Reset
    </button>
  </div>
  <?php echo form_close(); ?>
</div>