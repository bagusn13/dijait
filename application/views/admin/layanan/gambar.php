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
  echo form_open_multipart(base_url('admin/layanan/gambar/' . $layanan->id_layanan), ' class="form-horizontal"');
  ?>

  <div class="form-group">
    <label class="col-form-label">Judul Gambar</label>
    <input type="text" name="judul_gambar" class="form-control" placeholder="Judul Gambar Layanan" value="<?php echo set_value('judul_gambar') ?>" required>
  </div>

  <div class="form-group">
    <label class="col-form-label">Unggah Gambar</label>
    <input type="file" name="gambar" class="form-control-file" placeholder="Gambar Layanan" value="<?php echo set_value('gambar') ?>" required>
  </div>

  <div class="form-group">
    <button class="btn btn-success btn-lg" name="submit" type="submit">
      <i class="fa fa-save"></i> Simpan dan Unggah Gambar
    </button>
    <button class="btn btn-info btn-lg" name="reset" type="reset">
      <i class="fa fa-times"></i> Reset
    </button>
  </div>

  <?php echo form_close(); ?>

  <?php
  // Notifikasi
  if ($this->session->flashdata('sukses')) {
    echo '<p class="alert alert-success">';
    echo $this->session->flashdata('sukses');
    echo '</div>';
  }
  ?>

  <table class="table table-bordered" id="example1">
    <thead>
      <tr>
        <th>NO</th>
        <th>GAMBAR</th>
        <th>JUDUL</th>
        <th>ACTION</th>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td>1</td>
        <td>
          <img src="<?php echo base_url('assets/upload/image/thumbs/' . $layanan->gambar) ?>" class="img img-responsive img-thumbnail" width="60">
        </td>
        <td><?php echo $layanan->nama_layanan ?></td>

        <td>

        </td>

      </tr>
      <?php $no = 2;
      foreach ($gambar as $gambar) { ?>
        <tr>
          <td><?php echo $no ?></td>
          <td>
            <img src="<?php echo base_url('assets/upload/image/thumbs/' . $gambar->gambar) ?>" class="img img-responsive img-thumbnail" width="60">
          </td>
          <td><?php echo $gambar->judul_gambar ?></td>

          <td>
            <a href="<?php echo base_url('admin/layanan/delete_gambar/' . $layanan->id_layanan . '/' . $gambar->id_gambar) ?>" class="btn btn-danger btn-xs" onclick="return confirm('Yakin ingin menghapus gambar ini?')"><i class="fa fa-trash"></i> Hapus</a>
          </td>

        </tr>
      <?php $no++;
      } ?>
    </tbody>
  </table>
</div>