<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100">


  <div class="container">
    <div class="row">
      <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Keranjang Anda</span>
          <span class="badge badge-secondary badge-pill"><?php echo count($keranjang) ?></span>
        </h4>
        <ul class="list-group mb-3">
          <?php
          foreach ($keranjang as $keranjang) {
            $id_layanan = $keranjang['id'];
            $layanan    = $this->layanan_model->detail($id_layanan);
          ?>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0"><?php echo $keranjang['name'] ?></h6>
              </div>
              <span class="text-muted">
                <?php
                $sub_total = $keranjang['price'] * $keranjang['qty'];
                echo number_format($sub_total, '0', ',', '.');
                ?></span>
            </li>
          <?php
          }
          ?>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (IDR)</span>
            <strong>Rp. <?php echo number_format($this->cart->total(), '0', ',', '.') ?></strong>
          </li>
        </ul>


      </div>
      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Informasi alamat penerima</h4>
        <?php
        echo form_open(base_url('cart/checkout'));
        $kode_transaksi = strtoupper(random_string('numeric', 8)) . strtoupper(random_string('alnum', 8));
        ?>
        <input type="hidden" name="id_pelanggan" value="<?php echo $pelanggan->id_pelanggan; ?>">
        <input type="hidden" name="jumlah_transaksi" value="<?php echo $this->cart->total() ?>">
        <input type="hidden" name="tanggal_transaksi" value="<?php echo date('Y-m-d'); ?>">
        <form class="needs-validation" novalidate>
          <div class="mb-3">
            <label for="email">Kode Transaksi</label>
            <input type="text" name="kode_transaksi" class="form-control" value="<?php echo $kode_transaksi ?>" readonly required>
          </div>

          <div class="mb-3">
            <label for="fullname">Nama Penerima</label>
            <input type="text" name="nama_pelanggan" id="fullname" class="form-control" placeholder="Nama Lengkap" value="<?php echo $pelanggan->nama_pelanggan ?>" required>
            <div class="invalid-feedback">
              Nama Penerima harus diisi.
            </div>
          </div>

          <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo $pelanggan->email ?>" required>
            <div class="invalid-feedback">
              Email harus diisi.
            </div>
          </div>

          <div class="mb-3">
            <label for="telepon">Telepon Penerima</label>
            <input type="text" name="telepon" id="telepon" class="form-control" placeholder="Telepon" value="<?php echo $pelanggan->telepon ?>" required>
            <div class="invalid-feedback">
              Telepon Penerima harus diisi.
            </div>
          </div>

          <div class="mb-3">
            <label for="address">Alamat Lengkap</label>
            <input name="alamat" type="text" class="form-control" id="address" placeholder="Alamat" value="<?php echo $pelanggan->alamat ?>" required>
            <div class="invalid-feedback">
              Alamat Lengkap harus diisi.
            </div>
          </div>

          <div class="mb-3">
            <label for="instruksi">Instruksi <span class="text-muted">(Tambahan)</span></label>
            <textarea name="instruksi" type="text" class="form-control" id="instruksi" rows="3" placeholder="contoh: lingkar pinggang 39cm, potong 5cm, potong sesuai yang sudah ditandai, dan sebagainya" required></textarea>
            <div class="invalid-feedback">
              Instruksi harus diisi.
            </div>
          </div>

          <hr class="mb-4">

          <h4 class="mb-3">Metode Pembayaran</h4>

          <div class="d-block my-3">
            <div class="custom-control custom-radio">
              <input id="bank" name="paymentMethod" type="radio" class="custom-control-input" value="TRANSFER" checked required>
              <label class="custom-control-label" for="bank">Transfer Via Bank</label>
            </div>
            <div class="custom-control custom-radio">
              <input id="cod" name="paymentMethod" type="radio" class="custom-control-input" value="COD" required>
              <label class="custom-control-label" for="cod">Cash On Delivery</label>
            </div>
          </div>
          <hr class="mb-4">
          <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
        </form>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</section>