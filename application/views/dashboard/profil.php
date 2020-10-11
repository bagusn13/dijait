<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
  <div class="container">
    <div class="p-b-50">
      <div class="row">
        <div class="col-lg-9">
          <div class="box">
            <h1>Profil Saya</h1>
            <?php
            // display notifikasi error
            if ($this->session->flashdata('warning')) {
              echo '<div class="alert alert-warning">';
              echo $this->session->flashdata('warning');
              echo '</div>';
            }
            //notif
            if ($this->session->flashdata('sukses')) {
              echo '<div class="alert alert-success">';
              echo $this->session->flashdata('sukses');
              echo '</div>';
            }
            //display error
            echo validation_errors('<div class="alert alert-warning">', '</div>');

            //form open
            echo form_open(base_url('dashboard/profile'), 'class="leave-comment"'); ?>
            <form>
              <!-- <div class="row pt-4">
                <div class="col-md-4">
                  <div class="text-center">
                    <img src="<?php echo $pelanggan->foto ?>" class="rounded-circle img-thumbnail" width="200" alt="http://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                  </div>

                </div>
              </div> -->

              <div class="row mt-4">
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="email">Email</label>
                    <div class="col-sm-10">
                      <input id="email" type="email" name="email" class="form-control-plaintext" placeholder="Email" value="<?php echo $pelanggan->email ?>" readonly>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="nama">Nama</label>
                    <div class="col-sm-10">
                      <input id="nama" type="text" name="nama_pelanggan" class="form-control" placeholder="Nama Lengkap" value="<?php echo $pelanggan->nama_pelanggan ?>" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="telepon">Telepon</label>
                    <div class="col-sm-10">
                      <input id="telepon" type="text" name="telepon" class="form-control" placeholder="Telepon" value="<?php echo $pelanggan->telepon ?>" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
                    <div class="col-sm-10">
                      <textarea id="alamat" name="alamat" class="form-control" placeholder="Alamat" rows="3"><?php echo $pelanggan->alamat ?></textarea></textarea>
                    </div>
                  </div>

                </div>
              </div>

              <!-- /.row-->
              <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-light"><i class="fa fa-save"></i> Edit Profil</button>
                </div>
              </div>
            </form>
            <?php echo form_close(); ?>
          </div>
        </div>
        <div class="col-lg-3">
          <!-- sidebar menu -->
          <!-- <div class="card sidebar-menu">
            <div class="card-header">
              <h3 class="h4 card-title">Menu</h3>
            </div>
            <div class="card-body">
              <ul class="nav nav-pills flex-column">
                <a href="" class="nav-link"><i class="fa fa-home"></i> Beranda
                </a>
                <a href="" class="nav-link"><i class="fa fa-list"></i> Keranjang Belanja
                </a>
                <a href="" class="nav-link"><i class="fa fa-heart"></i> Riwayat Belanja
                </a>
                <a href="" class="nav-link"><i class="fa fa-user"></i> Profil Saya
                </a>
                <a href="" class="nav-link"><i class="fa fa-sign-out"></i> Logout
                </a>
              </ul>
            </div>
          </div> -->
          <!-- /.col-lg-3-->
          <!-- end sidebar menu -->
        </div>

      </div>
    </div>
  </div>

</section>