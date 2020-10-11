<div class="container">
  <h1>
    <?php echo $title ?>
  </h1>
  <br>
  <?php
  // Notifikasi error
  echo validation_errors('<div class="alert alert-warning">', '</div>');

  //form open
  echo form_open(base_url('admin/user/edit/' . $user->id_user), ' class="form-horizontal"');
  ?>
  <div class="form-group">
    <label class="control-label">Nama Pengguna</label>
    <input type="text" name="nama" class="form-control" placeholder="Nama Pengguna" value="<?php echo $user->nama ?>" required>
  </div>

  <div class="form-group">
    <label class="control-label">Email</label>
    <input type="email" name="email" class="form-control" placeholder="Email Pengguna" value="<?php echo $user->email ?>" required>
  </div>

  <div class="form-group">
    <label class="control-label">Username</label>
    <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $user->username ?>" readonly>
  </div>

  <div class="form-group">
    <label class="control-label">Password</label>
    <input type="password" name="password" class="form-control" placeholder="password" value="<?php echo set_value('password') ?>">
  </div>

  <div class="form-group">
    <label class="control-label">Level Hak Akses</label>
    <select name="akses_level" class="form-control">
      <option value="Admin">Admin</option>
      <option value="User" <?php if ($user->akses_level == "User") {
                              echo "selected";
                            } ?>>User</option>
    </select>
  </div>

  <div class="form-group">
    <label class="control-label"></label>
    <button class="btn btn-success btn-lg" name="submit" type="submit">
      <i class="fa fa-save"></i> Simpan
    </button>
    <button class="btn btn-info btn-lg" name="reset" type="reset">
      <i class="fa fa-times"></i> Reset
    </button>
  </div>
  <?php echo form_close(); ?>
</div>