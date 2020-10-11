<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">
    <?php echo $title ?>
  </h1>
  <br>
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
              <th>Pelanggan</th>
              <th>KODE</th>
              <th>TANGGAL</th>
              <th>TOTAL</th>
              <th>QTY</th>
              <th>STATUS BAYAR</th>
              <th>ACTION</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1;
            foreach ($header_transaksi as $header_transaksi) { ?>
              <tr>
                <td><?php echo $i ?></td>
                <td>
                  <?php echo $header_transaksi->nama_pelanggan ?>
                  <br><small>
                    Telepon: <?php echo $header_transaksi->telepon ?>
                    <br>Email: <?php echo $header_transaksi->email ?>
                    <br>Alamat: <?php echo nl2br($header_transaksi->alamat) ?>
                  </small>
                </td>
                <td><?php echo $header_transaksi->kode_transaksi ?></td>
                <td><?php echo date('d-m-Y', strtotime($header_transaksi->tanggal_transaksi)) ?></td>
                <td><?php echo number_format($header_transaksi->jumlah_transaksi) ?></td>
                <td><?php echo $header_transaksi->total_item ?></td>
                <td><?php echo $header_transaksi->status_bayar ?></td>
                <td>
                  <div class="btn-group">
                    <a href="<?php echo base_url('admin/transaksi/detail/' . $header_transaksi->kode_transaksi) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> Detail</a>
                    <a href="<?php echo base_url('admin/transaksi/cetak/' . $header_transaksi->kode_transaksi) ?>" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-print"></i> Cetak</a>
                    <a href="<?php echo base_url('admin/transaksi/status/' . $header_transaksi->kode_transaksi) ?>" class="btn btn-warning btn-sm"><i class="fa fa-check"></i> Update Status</a>
                  </div>
                </td>
              </tr>
            <?php $i++;
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>