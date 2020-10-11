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
  echo form_open_multipart(base_url('admin/testi/edit/' . $testi->id_testi), ' class="form-horizontal"');
  ?>
  <div class="form-group">
    <label class="col-form-label">Nama Pelanggan</label>
    <input type="text" name="nama_pelanggan" class="form-control" placeholder="Nama Pelanggan" value="<?php echo $testi->nama_pelanggan ?>" required>
  </div>

  <div class="form-group">
    <label class="col-form-label">Pekerjaan</label>
    <input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan" value="<?php echo $testi->pekerjaan ?>" required>
  </div>

  <div class="form-group">
    <label class="col-form-label">Testimoni</label>
    <textarea name="testimoni" class="form-control" placeholder="Testimoni"><?php echo $testi->testimoni ?></textarea>
  </div>

  <div class="form-group form-group-lg">
    <label class="col-form-label">Upload Foto Pelanggan</label>
    <input type="file" name="gambar" class="form-control-file">
  </div>

  <div class="form-group">
    <label class="col-form-label">Status Berita</label>
    <select name="status_testi" class="form-control">
      <option value="Publish">Publikasikan</option>
      <option value="Draft" <?php if ($testi->status_testi == "Draft") {
                              echo "selected";
                            } ?>>Simpan Sebagai Draft</option>
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