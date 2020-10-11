<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">
    <?php echo $title ?>
  </h1>
  <br>
  <p>
    <a href="<?php echo base_url('admin/kategori/tambah') ?>" class="btn btn-success btn-lg"><i class="fa fa-plus"></i> Tambah Baru
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
        <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>NO</th>
              <th>NAMA</th>
              <th>SLUG</th>
              <th>URUTAN</th>
              <th>ACTION</th>
            </tr>
          </thead>

          <tbody>
            <?php $no = 1;
            foreach ($kategori as $kategori) { ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $kategori->nama_kategori ?></td>
                <td><?php echo $kategori->slug_kategori ?></td>
                <td><?php echo $kategori->urutan ?></td>
                <td>
                  <a href="<?php echo base_url('admin/kategori/edit/' . $kategori->id_kategori) ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a>
                  <a href="<?php echo base_url('admin/kategori/delete/' . $kategori->id_kategori) ?>" class="btn btn-danger btn-xs" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i> Hapus</a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>