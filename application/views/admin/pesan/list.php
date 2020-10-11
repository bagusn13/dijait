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
              <th>NAMA</th>
              <th>EMAIL</th>
              <th>PESAN</th>
            </tr>
          </thead>

          <tbody>
            <?php $no = 1;
            foreach ($pesan as $pesan) { ?>
              <tr>
                <td><?php echo $no ?></td>
                <td>
                  <?php echo $pesan->nama ?>
                </td>
                <td>
                  <?php echo $pesan->email ?>
                </td>
                <td>
                  <?php echo $pesan->pesan ?>
                </td>
              </tr>
            <?php $no++;
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>