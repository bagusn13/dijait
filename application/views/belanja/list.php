<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0"><a href="<?php echo base_url() ?>">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Cart</strong></div>
    </div>
  </div>
</div>



<div class="site-section">
  <div class="container">
    <?php if ($this->session->flashdata('sukses')) {
      echo '<div class="alert alert-warning">';
      echo $this->session->flashdata('sukses');
      echo '</div>';
    } ?>
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
            </tbody>
          </table>
        </div>
      </form>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="row mb-5">
          <div class="button-link col-md-6 mb-3 mb-md-0">
            <a href="<?php echo base_url('cart/delete') ?>" class="btn btn-primary btn-sm btn-block" style="padding-top: 11.5px;">Bersihkan Keranjang</a>
          </div>
          <div class="button-link col-md-6">
            <a href="<?php echo base_url('service') ?>" class="btn btn-outline-primary btn-sm btn-block" style="padding-top: 11.5px;">Continue Shopping</a>
          </div>
        </div>
        <!-- <div class="row">
          <div class="col-md-12">
            <label class="text-black h4" for="coupon">Coupon</label>
            <p>Enter your coupon code if you have one.</p>
          </div>
          <div class="col-md-8 mb-3 mb-md-0">
            <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
          </div>
          <div class="col-md-4">
            <button class="btn btn-primary btn-sm px-4">Apply Coupon</button>
          </div>
        </div> -->
      </div>
      <div class="col-md-6 pl-5">
        <div class="row justify-content-end">
          <div class="col-md-7">
            <div class="row">
              <div class="col-md-12 text-right border-bottom mb-5">
                <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <span class="text-black">Subtotal</span>
              </div>
              <div class="col-md-6 text-right">
                <strong class="text-black">Rp. <?php echo number_format($this->cart->total(), '0', ',', '.') ?></strong>
              </div>
            </div>
            <div class="row mb-5">
              <div class="col-md-6">
                <span class="text-black">Total</span>
              </div>
              <div class="col-md-6 text-right">
                <strong class="text-black">Rp. <?php echo number_format($this->cart->total(), '0', ',', '.') ?></strong>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <?php if (count($keranjang) == null) { ?>
                  <a class="btn btn-primary btn-lg btn-block disabled" style="padding-top: 11.5px;" href="#" aria-disabled="true">Proceed To Checkout</a>
                <?php } else { ?>
                  <a class="btn btn-primary btn-lg btn-block" style="padding-top: 11.5px;" href="<?php echo base_url('cart/checkout') ?>">Proceed To Checkout</a>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>