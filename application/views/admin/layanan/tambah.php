<div class="container">
  <h1>
    <?php echo $title ?>
  </h1>
  <br>

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
  echo form_open_multipart(base_url('admin/layanan/tambah'), ' class="form-horizontal"');
  ?>
  <div class="form-group">
    <label class="col-form-label">Nama Layanan</label>
    <input type="text" name="nama_layanan" class="form-control" placeholder="Nama Layanan" value="<?php echo set_value('nama_layanan') ?>" required>
  </div>

  <div class="form-group">
    <label class="col-form-label">Kode Layanan</label>
    <input type="text" name="kode_layanan" class="form-control" placeholder="Kode Layanan" value="<?php echo set_value('kode_layanan') ?>">
  </div>

  <div class="form-group">
    <label class="col-form-label">Kategori Layanan</label>
    <select name="id_kategori" class="form-control">
      <?php foreach ($kategori as $kategori) { ?>
        <option value="<?php echo $kategori->id_kategori ?>"><?php echo $kategori->nama_kategori ?></option>
      <?php } ?>
    </select>
  </div>

  <div class="form-group">
    <label class="col-form-label">Harga Layanan</label>
    <input type="number" name="harga" class="form-control" placeholder="Harga Layanan" value="<?php echo set_value('harga') ?>" required>
  </div>

  <div class="form-group">
    <label class="col-form-label">Keterangan Layanan</label>
    <textarea name="keterangan" class="form-control" placeholder="Keterangan" id="editor"><?php echo set_value('keterangan') ?></textarea>
  </div>

  <div class="form-group">
    <label class="col-form-label">Keyword (untuk SEO google)</label>
    <textarea name="keywords" class="form-control" placeholder="Keyword (untuk SEO google)"><?php echo set_value('keywords') ?></textarea>
  </div>

  <div class="form-group form-group-lg">
    <label class="col-form-label">Upload Gambar Layanan</label>
    <input type="file" name="gambar" class="form-control-file" required="required">
  </div>

  <div class="form-group">
    <label class="col-form-label">Status Layanan</label>
    <select name="status_layanan" class="form-control">
      <option value="Publish">Publikasikan</option>
      <option value="Draft">Simpan Sebagai Draft</option>
    </select>
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