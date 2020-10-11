<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">
    <?php echo $title ?>
  </h1>
  <br>

  <p>
    <a href="<?php echo base_url('admin/berita/tambah') ?>" class="btn btn-success btn-lg"><i class="fa fa-plus"></i> Tambah Baru
    </a>
  </p>

  <?php
  // Notifikasi
  if ($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-success">';
    echo $this->session->flashdata('sukses');
    echo '</div>';
  }
  ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><?php echo $title ?></h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>NO</th>
              <th>GAMBAR</th>
              <th>JUDUL</th>
              <th>KETERANGAN</th>
              <th>LINK</th>
              <th>STATUS</th>
              <th colspan="2">ACTION</th>
            </tr>
          </thead>

          <tbody>
            <?php $no = 1;
            foreach ($berita as $berita) { ?>
              <tr>
                <td><?php echo $no ?></td>
                <td>
                  <img src="<?php echo base_url('assets/upload/image/thumbs/instagram/' . $berita->gambar) ?>" class="img img-responsive img-thumbnail" width="60">
                </td>
                <td><?php echo $berita->judul_berita ?></td>
                <td><?php echo $berita->keterangan ?></td>
                <td><?php echo $berita->link ?></td>
                <td><?php echo $berita->status_berita ?></td>
                <td>
                  <a href="<?php echo base_url('admin/berita/edit/' . $berita->id_berita) ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a>
                </td>
                <td>
                  <?php include('delete.php') ?>
                </td>
              </tr>
            <?php $no++;
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>