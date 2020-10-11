<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
  <div class="container">
    <div class="dashboard-user">
      <div class="p-b-50">
        <div class="p-t-15 p-b-40">
          <h2><?php echo $title ?></h2>
        </div>

        <!--Table-->
        <?php
        //jika ada transaksi, tampilkan tabel
        if ($header_transaksi) { ?>
          <div class="table-responsive-md">
            <table class="table table-bordered w-auto">

              <!--Table head-->
              <thead>
                <tr>
                  <th>NO</th>
                  <th>KODE</th>
                  <th>TANGGAL</th>
                  <th>TOTAL</th>
                  <th>QTY</th>
                  <th colspan="2">STATUS BAYAR</th>
                </tr>
              </thead>
              <!--Table head-->

              <!--Table body-->
              <tbody>
                <?php $i = 1;
                foreach ($header_transaksi as $header_transaksi) { ?>
                  <tr>
                    <th scope="row"><?php echo $i ?></th>
                    <td><?php echo $header_transaksi->kode_transaksi ?></td>
                    <td><?php echo date('d-m-Y', strtotime($header_transaksi->tanggal_transaksi)) ?></td>
                    <td><?php echo number_format($header_transaksi->jumlah_transaksi) ?></td>
                    <td><?php echo $header_transaksi->total_item ?></td>
                    <td><?php echo $header_transaksi->status_bayar ?></td>
                    <td>
                      <a href="<?php echo base_url('dashboard/detail/' . $header_transaksi->kode_transaksi) ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Detail</a>
                    </td>
                  </tr>
                <?php $i++;
                } ?>
              </tbody>
              <!--Table body-->


            </table>
          </div>

        <?php
          //kalau tidak ada tampilkan notif
        } else { ?>
          <p class="alert alert-success">
            <i class="fa fa-warning"></i> Belum ada data transaksi
          </p>
        <?php } ?>
        <!--Table-->
      </div>
    </div>

  </div>
</section>