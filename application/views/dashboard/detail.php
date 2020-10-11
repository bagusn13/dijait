<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-md-9 col-lg-9 p-b-50">
        <h2><?php echo $title ?></h2>
        <hr>
        <p>Berikut adalah riwayat belanja anda</p>
        <?php
        //jika ada transaksi, tampilkan tabel
        if ($header_transaksi) { ?>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>KODE TRANSAKSI</th>
                <th>: <?php echo $header_transaksi->kode_transaksi ?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Tanggal</td>
                <td>: <?php echo date('d-m-Y', strtotime($header_transaksi->tanggal_transaksi)) ?></td>
              </tr>
              <tr>
                <td>Jumlah total</td>
                <td>: <?php echo number_format($header_transaksi->jumlah_transaksi) ?></td>
              </tr>
              <tr>
                <td>Metode Bayar</td>
                <td>: <?php echo $header_transaksi->metode_bayar ?></td>
              </tr>
              <tr>
                <td>Status Bayar</td>
                <td>: <?php echo $header_transaksi->status_bayar ?></td>
              </tr>
            </tbody>
          </table>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>NO</th>
                <th>KODE</th>
                <th>NAMA LAYANAN</th>
                <th>JUMLAH</th>
                <th>HARGA</th>
                <th>SUB TOTAL</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($transaksi as $transaksi) { ?>
                <tr>
                  <td><?php echo $i ?></td>
                  <td><?php echo $transaksi->kode_layanan ?></td>
                  <td><?php echo $transaksi->nama_layanan ?></td>
                  <td><?php echo number_format($transaksi->jumlah) ?></td>
                  <td><?php echo number_format($transaksi->harga) ?></td>
                  <td><?php echo number_format($transaksi->total_harga) ?></td>
                </tr>
              <?php $i++;
              } ?>
            </tbody>
          </table>


        <?php
          //kalau tidak ada tampilkan notif
        } else { ?>
          <p class="alert alert-success">
            <i class="fa fa-warning"></i> Belum ada data transaksi
          </p>
        <?php } ?>

      </div>
    </div>
  </div>
</section>