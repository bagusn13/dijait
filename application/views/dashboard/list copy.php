<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
  <div class="container">
    <div class="p-b-50">

      <?php // display notifikasi error
      if ($this->session->flashdata('warning')) {
        echo '<div class="alert alert-warning">';
        echo $this->session->flashdata('warning');
        echo '</div>';
      }

      // display notifikasi sukses
      if ($this->session->flashdata('sukses')) {
        echo '<div class="alert alert-success">';
        echo $this->session->flashdata('sukses');
        echo '</div>';
      }
      ?>
      <div class="">
        <h1>Selamat datang <i><strong><?php echo $this->session->userdata('nama_pelanggan'); ?></strong></i></h1>
      </div>

      <?php if ($pelanggan->status_pelanggan == 'Pending') { ?>
        <div class="alert alert-success">
          <h4>verifikasi akun anda <a href="<?php echo base_url('dashboard/verification') ?>">klik disini</a></h4>
        </div>
      <?php } ?>

      <?php
      //jika ada transaksi, tampilkan tabel
      if ($header_transaksi) { ?>

        <table class="table table-bordered w-auto">
          <thead>
            <tr>
              <th>NO</th>
              <th>KODE</th>
              <th>TANGGAL</th>
              <th>JUMLAH TOTAL</th>
              <th>JUMLAH ITEM</th>
              <th colspan="2">STATUS BAYAR</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1;
            foreach ($header_transaksi as $header_transaksi) { ?>
              <tr>
                <td><?php echo $i ?></td>
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
        </table>

      <?php
        //kalau tidak ada tampilkan notif
      } else { ?>
        <p class="alert alert-success">
          <i class="fa fa-warning"></i> Belum ada data transaksi
        </p>
      <?php } ?>

    </div>

    <div class="p-b-50">
      <!--Table-->
      <table class="table table-bordered w-auto">

        <!--Table head-->
        <thead>
          <tr>
            <th>NO</th>
            <th>KODE</th>
            <th>TANGGAL</th>
            <th>JUMLAH TOTAL</th>
            <th>JUMLAH ITEM</th>
            <th colspan="2">STATUS BAYAR</th>
          </tr>
        </thead>
        <!--Table head-->

        <!--Table body-->
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Kate</td>
            <td>Moss</td>
            <td>USA</td>
            <td>New York City</td>
            <td>Web Designer</td>
          </tr>
        </tbody>
        <!--Table body-->


      </table>
      <!--Table-->
    </div>
  </div>
</section>