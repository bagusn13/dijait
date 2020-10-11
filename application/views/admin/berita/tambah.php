<div class="container">
  <h1>
    <?php echo $title ?>
  </h1>
  <br>
  <?php
  //error upload
  if (isset($error)) {
    echo '<p class="alert alert-warning">';
    echo $error;
    echo '</p>';
  }

  // Notifikasi error
  echo validation_errors('<div class="alert alert-warning">', '</div>');

  //form open
  //multipart itu untuk form yang ada upload gambarnya, 
  //jadi bukan hanya entry data saja
  echo form_open_multipart(base_url('admin/berita/tambah'), ' class="form-horizontal"');
  ?>
  <div class="form-group">
    <label class="col-form-label">Judul Berita</label>
    <input type="text" name="judul_berita" class="form-control" placeholder="Judul Berita" value="<?php echo set_value('judul_berita') ?>" required>
  </div>

  <div class="form-group">
    <label class="col-form-label">Jenis Berita</label>
    <input type="text" name="jenis_berita" class="form-control" placeholder="Jenis Berita" value="<?php echo set_value('jenis_berita') ?>" required>
  </div>

  <div class="form-group">
    <label class="col-form-label">Link</label>
    <input type="text" name="link" class="form-control" placeholder="Link Berita" value="<?php echo set_value('link') ?>" required>
  </div>

  <div class="form-group">
    <label class="col-form-label">Keterangan Berita</label>
    <textarea name="keterangan" class="form-control" placeholder="Keterangan" id=""><?php echo set_value('keterangan') ?></textarea>
  </div>

  <div class="form-group">
    <label class="col-form-label">Keyword (untuk SEO google)</label>
    <textarea name="keywords" class="form-control" placeholder="Keyword (untuk SEO google)"><?php echo set_value('keywords') ?></textarea>
  </div>

  <div class="form-group form-group-lg">
    <label class="col-form-label">Upload Gambar Instagram</label>
    <input type="file" name="gambar" class="form-control-file" required="required">
  </div>

  <div class="form-group">
    <label class="col-form-label">Status Berita</label>
    <select name="status_berita" class="form-control">
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