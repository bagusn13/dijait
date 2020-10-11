<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">
    <?php echo $title ?>
  </h1>
  <br>
  <p>
    <a href="<?php echo base_url('admin/rekening/tambah') ?>" class="btn btn-success btn-lg"><i class="fa fa-plus"></i> Tambah Baru
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
              <th>NAMA BANK</th>
              <th>NOMOR REKENING</th>
              <th>PEMILIK</th>
              <th colspan="2">ACTION</th>
            </tr>
          </thead>

          <tbody>
            <?php $no = 1;
            foreach ($rekening as $rekening) { ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $rekening->nama_bank ?></td>
                <td><?php echo $rekening->nomor_rekening ?></td>
                <td><?php echo $rekening->nama_pemilik ?></td>
                <td>
                  <a href="<?php echo base_url('admin/rekening/edit/' . $rekening->id_rekening) ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a>
                </td>
                <td>
                  <a href="<?php echo base_url('admin/rekening/delete/' . $rekening->id_rekening) ?>" class="btn btn-danger btn-xs" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i> Hapus</a>
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