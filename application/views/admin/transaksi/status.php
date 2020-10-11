<div class="container-fluid">
  <p class="">
    <div class="btn-group float-sm-right">
      <a href="<?php echo base_url('admin/transaksi/cetak/' . $header_transaksi->kode_transaksi) ?>" target="_blank" title="Cetak" class="btn btn-success btn-sm">
        <i class="fa fa-print"></i> Cetak
      </a>
      <a href="<?php echo base_url('admin/transaksi') ?>" title="Kembali" class="btn btn-info btn-sm">
        <i class="fa fa-backward"></i> Kembali
      </a>
    </div>
  </p>
  <div class="clearfix"></div>
  <br>

  <?php
  //form open
  echo form_open_multipart(base_url('admin/transaksi/status/' . $header_transaksi->kode_transaksi), ' class="form-horizontal"');
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
              <th>Nama Pelanggan</th>
              <th>: <?php echo $header_transaksi->nama_pelanggan ?></th>
            </tr>
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
            <?php if ($header_transaksi->metode_bayar == "COD") { ?>
              <tr>
                <td>Status Bayar</td>
                <td>
                  <div class="form-group">
                    <!-- <label for="exampleFormControlSelect1">Example select</label> -->
                    <select name="status_bayar" class="form-control">
                      <option value="Sukses">Sukses</option>
                      <option value="Gagal">Gagal</option>
                      <option value="Pending">Pending</option>
                    </select>
                  </div>
                </td>
              </tr>
            <?php } else { ?>
              <tr>
                <td>Status Bayar</td>
                <td>
                  <div class="form-group">
                    <!-- <label for="exampleFormControlSelect1">Example select</label> -->
                    <select name="status_bayar" class="form-control">
                      <option value="Sukses">Sukses</option>
                      <option value="Gagal">Gagal</option>
                      <option value="Pending">Pending</option>
                    </select>
                  </div>
                </td>
              </tr>
              <tr>
                <td>Bukti Bayar</td>
                <td>
                  : <?php if ($header_transaksi->bukti_bayar == "") {
                      echo 'Belum ada';
                    } else { ?>
                    <img src="<?php echo base_url('assets/upload/image/' . $header_transaksi->bukti_bayar) ?>" class="img img-thumbnail" width="200">
                  <?php } ?>
                </td>
              </tr>
              <tr>
                <td>Tanggal Bayar</td>
                <td>:
                  <?php if ($header_transaksi->metode_bayar == "COD") {
                    echo date('d-m-Y', strtotime($header_transaksi->tanggal_transaksi));
                  } else {
                    echo date('d-m-Y', strtotime($header_transaksi->tanggal_bayar));
                  } ?>
                </td>
              </tr>
              <tr>
                <td>Jumlah Bayar</td>
                <td>: Rp. <?php echo number_format($header_transaksi->jumlah_bayar, '0', ',', '.') ?></td>
              </tr>
              <tr>
                <td>Pembayaran Dari</td>
                <td>: <?php echo $header_transaksi->nama_bank ?> No. rekening <?php echo $header_transaksi->rekening_pembayaran ?> a.n <?php echo $header_transaksi->rekening_pelanggan ?></td>
              </tr>
              <tr>
                <td>Pembayaran ke Rekening</td>
                <td>: <?php echo $header_transaksi->bank ?> No. rekening <?php echo $header_transaksi->nomor_rekening ?> a.n <?php echo $header_transaksi->nama_pemilik ?></td>
              </tr>
            <?php } ?>
            <tr>
              <td></td>
              <td>
                <button class="btn btn-success btn-lg" type="submit">
                  <i class="fa fa-save"></i> Update Status
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <?php echo form_close(); ?>

  <hr>

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
      </div>
    </div>
  </div>

</div>