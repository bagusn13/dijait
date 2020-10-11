<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100">
  <div class="container">
    <!-- cart item -->
    <div class="container-table-cart pos-relative">
      <div class="row mb-5">
        <form class="col-md-12" method="post">
          <div class="site-blocks-table">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="product-thumbnail">Image</th>
                  <th class="product-name">Product</th>
                  <th class="product-price">Price</th>
                  <th class="product-quantity">Quantity</th>
                  <th class="product-total">Total</th>
                  <th class="product-remove" colspan="3">Update</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($keranjang as $keranjang) {
                  $id_layanan = $keranjang['id'];
                  $layanan    = $this->layanan_model->detail($id_layanan);

                  echo form_open(base_url('cart/update_cart/' . $keranjang['rowid']));
                ?>
                  <tr>
                    <td class="product-thumbnail">
                      <img src="<?php echo base_url('assets/upload/image/thumbs/' . $layanan->gambar) ?>" alt="<?php echo $keranjang['name'] ?>" class="img-fluid">
                    </td>
                    <td class="product-name">
                      <h2 class="h5 text-black"><?php echo $keranjang['name'] ?></h2>
                    </td>
                    <td>Rp. <?php echo number_format($keranjang['price'], '0', ',', '.') ?></td>
                    <td>
                      <div class="input-group mb-3" style="max-width: 120px;">
                        <div class="input-group-prepend">
                          <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                        </div>
                        <input type="text" class="form-control text-center" name="qty" value="<?php echo $keranjang['qty'] ?>" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                        <div class="input-group-append">
                          <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                        </div>
                      </div>

                    </td>
                    <td>
                      Rp.
                      <?php
                      $sub_total = $keranjang['price'] * $keranjang['qty'];
                      echo number_format($sub_total, '0', ',', '.');
                      ?>
                    </td>
                    <td>
                      <button type="submit" name="submit" class="btn btn-primary height-auto btn-sm">Update</button>
                    </td>
                    <td>
                      <a href="<?php echo base_url('cart/delete/' . $keranjang['rowid']) ?>" class="btn btn-primary height-auto btn-sm">Hapus</a>
                    </td>
                  </tr>
                <?php
                  echo form_close();
                }
                ?>
                <tr class="table-row">
                  <td colspan='5' class="column-1">Total Belanja</td>
                  <td colspan="2" class="column-2">Rp. <?php echo number_format($this->cart->total(), '0', ',', '.') ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </form>
      </div>
      <br>

      <?php
      echo form_open(base_url('cart/checkout'));
      $kode_transaksi = date('dmY') . strtoupper(random_string('alnum', 8));
      ?>
      <input type="hidden" name="id_pelanggan" value="<?php echo $pelanggan->id_pelanggan; ?>">
      <input type="hidden" name="jumlah_transaksi" value="<?php echo $this->cart->total() ?>">
      <input type="hidden" name="tanggal_transaksi" value="<?php echo date('Y-m-d'); ?>">
      <table class="table">
        <thead>
          <tr>
            <th width="25%">Kode Transaksi</th>
            <th><input type="text" name="kode_transaksi" class="form-control" value="<?php echo $kode_transaksi ?>" readonly required></th>
          </tr>
          <tr>
            <th width="25%">Nama Penerima</th>
            <th><input type="text" name="nama_pelanggan" class="form-control" placeholder="Nama Lengkap" value="<?php echo $pelanggan->nama_pelanggan ?>" required></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Email Penerima</td>
            <td><input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $pelanggan->email ?>" required></td>
          </tr>
          <tr>
            <td>Telepon Penerima</td>
            <td><input type="text" name="telepon" class="form-control" placeholder="Telepon" value="<?php echo $pelanggan->telepon ?>" required></td>
          </tr>
          <tr>
            <td>Alamat pengiriman</td>
            <td><textarea name="alamat" class="form-control" placeholder="Alamat"><?php echo $pelanggan->alamat ?></textarea></td>
          </tr>
          <tr>
            <td></td>
            <td>
              <button class="btn btn-success btn-lg" type="submit">
                <i class="fa fa-save"></i> Checkout Sekarang
              </button>
              <button class="btn btn-default btn-lg" type="reset">
                <i class="fa fa-times"></i> Reset
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      <?php echo form_close(); ?>

    </div>
  </div>


  <div class="container">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Billing address</h4>
        <form class="needs-validation" novalidate>
          <div class="mb-3">
            <label for="email">Kode Transaksi</label>
            <input type="email" class="form-control" id="email" placeholder="you@example.com">
            <div class="invalid-feedback">
              Please enter a valid email address for shipping updates.
            </div>
          </div>

          <div class="mb-3">
            <label for="firstName">Nama Penerima</label>
            <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>

          <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="you@example.com">
            <div class="invalid-feedback">
              Please enter a valid email address for shipping updates.
            </div>
          </div>

          <div class="mb-3">
            <label for="Telepon">Telepon Penerima</label>
            <input type="text" class="form-control" id="Telepon" placeholder="Apartment or suite">
          </div>

          <div class="mb-3">
            <label for="address">Alamat Lengkap</label>
            <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
            <div class="invalid-feedback">
              Please enter your shipping address.
            </div>
          </div>

          <hr class="mb-4">

          <h4 class="mb-3">Payment</h4>

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
      </div>
    </div>
  </div>
</section>