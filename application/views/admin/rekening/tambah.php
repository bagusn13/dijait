<div class="container">
  <h1>
    <?php echo $title ?>
  </h1>
  <br>
  <?php
  // Notifikasi error
  echo validation_errors('<div class="alert alert-warning">', '</div>');

  //form open
  echo form_open(base_url('admin/rekening/tambah'), ' class="form-horizontal"');
  ?>
  <div class="form-group">
    <label class="col-form-label">Nama Bank</label>
    <input type="text" name="nama_bank" class="form-control" placeholder="Nama Bank" value="<?php echo set_value('nama_bank') ?>" required>
  </div>

  <div class="form-group">
    <label class="col-form-label">Nomor Rekening</label>
    <input type="number" name="nomor_rekening" class="form-control" placeholder="Nomor Rekening" value="<?php echo set_value('nomor_rekening') ?>" required>
  </div>

  <div class="form-group">
    <label class="col-form-label">Nama Pemilik Rekening (atas nama)</label>
    <input type="text" name="nama_pemilik" class="form-control" placeholder="Nama Pemilik Rekening" value="<?php echo set_value('nama_pemilik') ?>" required>
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