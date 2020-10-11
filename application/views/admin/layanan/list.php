<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">
    <?php echo $title ?>
  </h1>
  <br>
  <p>
    <a href="<?php echo base_url('admin/layanan/tambah') ?>" class="btn btn-success btn-lg"><i class="fa fa-plus"></i> Tambah Baru
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
              <th>NAMA</th>
              <th>KATEGORI</th>
              <th>HARGA</th>
              <th>STATUS</th>
              <th colspan="3">ACTION</th>
            </tr>
          </thead>

          <tbody>
            <?php $no = 1;
            foreach ($layanan as $layanan) { ?>
              <tr>
                <td><?php echo $no ?></td>
                <td>
                  <img src="<?php echo base_url('assets/upload/image/thumbs/' . $layanan->gambar) ?>" class="img img-responsive img-thumbnail" width="60">
                </td>
                <td><?php echo $layanan->nama_layanan ?></td>
                <td><?php echo $layanan->nama_kategori ?></td>
                <td>Rp. <?php echo number_format($layanan->harga, '0', ',', '.') ?></td>
                <td><?php echo $layanan->status_layanan ?></td>
                <td>
                  <a href="#" class="btn btn-success btn-xs"><i class="fa fa-image"></i> Gambar (<?php echo $layanan->total_gambar ?>)</a>
                </td>
                <td>
                  <a href="<?php echo base_url('admin/layanan/edit/' . $layanan->id_layanan) ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a>
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