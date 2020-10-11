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
  echo form_open_multipart(base_url('admin/konfigurasi'), ' class="form-horizontal"');
  ?>

  <div class="form-group">
    <label class="col-form-label">Nama Website</label>
    <input type="text" name="namaweb" class="form-control" placeholder="Nama Website" value="<?php echo $konfigurasi->namaweb ?>" required>
  </div>

  <div class="form-group">
    <label class="col-form-label">Tagline</label>
    <input type="text" name="tagline" class="form-control" placeholder="Tagline" value="<?php echo $konfigurasi->tagline ?>" required>
  </div>

  <div class="form-group">
    <label class="col-form-label">Email</label>
    <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $konfigurasi->email ?>" required>
  </div>

  <div class="form-group">
    <label class="col-form-label">Website</label>
    <input type="text" name="website" class="form-control" placeholder="Website" value="<?php echo $konfigurasi->website ?>" required>
  </div>

  <div class="form-group">
    <label class="col-form-label">Facebook</label>
    <input type="text" name="facebook" class="form-control" placeholder="Facebook" value="<?php echo $konfigurasi->facebook ?>" required>
  </div>

  <div class="form-group">
    <label class="col-form-label">Instagram</label>
    <input type="text" name="instagram" class="form-control" placeholder="Instagram" value="<?php echo $konfigurasi->instagram ?>" required>
  </div>

  <div class="form-group">
    <label class="col-form-label">Telepon</label>
    <input type="text" name="telepon" class="form-control" placeholder="Telepon" value="<?php echo $konfigurasi->telepon ?>" required>
  </div>

  <div class="form-group">
    <label class="col-form-label">Alamat</label>
    <textarea name="alamat" class="form-control" placeholder="Alamat"><?php echo $konfigurasi->alamat ?></textarea>
  </div>

  <div class="form-group">
    <label class="col-form-label">Keyword (untuk SEO google)</label>
    <textarea name="keywords" class="form-control" placeholder="Keyword (untuk SEO google)"><?php echo $konfigurasi->keywords ?></textarea>
  </div>

  <div class="form-group">
    <label class="col-form-label">Metatext</label>
    <textarea name="metatext" class="form-control" placeholder="Metatext"><?php echo $konfigurasi->metatext ?></textarea>
  </div>

  <div class="form-group">
    <label class="col-form-label">Deskripsi</label>
    <textarea name="deskripsi" class="form-control" placeholder="Deskripsi"><?php echo $konfigurasi->deskripsi ?></textarea>
  </div>

  <div class="form-group">
    <label class="col-form-label">Rekening Pembayaran</label>
    <textarea name="rekening_pembayaran" class="form-control" placeholder="Rekening Pembayaran"><?php echo $konfigurasi->rekening_pembayaran ?></textarea>
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