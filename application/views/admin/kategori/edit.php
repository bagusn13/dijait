<div class="container">
  <h1>
    <?php echo $title ?>
  </h1>
  <br>
  <?php
  // Notifikasi error
  echo validation_errors('<div class="alert alert-warning">', '</div>');

  //form open
  echo form_open(base_url('admin/kategori/edit/' . $kategori->id_kategori), ' class="form-horizontal"');
  ?>
  <div class="form-group">
    <label class="col-form-label">Nama Kategori</label>
    <input type="text" name="nama_kategori" class="form-control" placeholder="Nama Kategori" value="<?php echo $kategori->nama_kategori ?>" required>
  </div>

  <div class="form-group">
    <label class="col-form-label">Urutan</label>
    <input type="number" name="urutan" class="form-control" placeholder="Urutan" value="<?php echo $kategori->urutan ?>" required>
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