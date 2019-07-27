<?php
    include '../../includes/dbh.inc.php';
    if(isset($_POST['nourut'])){
      $sql = "SELECT * FROM tps WHERE id=".$_POST['nourut'];
      $dataTPS = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($dataTPS);
    }
?>
<div id="modal-ubah-data-tps" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document" at>
    <div class="modal-content">
      <div class="modal-header d-block" style="background-color: #e2e2e2; padding-bottom: 0;">
          <h5 class="modal-title text-center">Ubah Data Akun TPS</h5>
          <button type="button" class="close position-relative" style="top: -35px" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body" style="background-color: #e2e2e2">
        <form id="form-ubah-data-tps" method="post">
            <div class="form-group row">
                <label for="uname" class="col-sm-3 col-form-label">Username TPS</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="uname" value="<?php echo $row['uname_tps']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="namatps" class="col-sm-3 col-form-label">Nama TPS</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="namatps" value="<?php echo $row['nama_tps']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="pwdlama" class="col-sm-3 col-form-label">Password Lama TPS</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" name="pwdlama" placeholder="Kosongkan bila tidak ingin ubah password">
                </div>
            </div>
            <div class="form-group row">
                <label for="pwdbaru" class="col-sm-3 col-form-label">Password Baru TPS</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" name="pwdbaru" placeholder="Kosongkan bila tidak ingin ubah password">
                    <input type="hidden" class="form-control" name="id" value="<?php echo $row['id']; ?>">
                </div>
            </div>
        </form>
          <h5 class="status-upload text-center"></h5>
      </div>
      <div class="modal-footer" style="background-color: #e2e2e2">
          <input id="btn-simpan-ubah-data-tps" type="submit" form="form-ubah-data-tps" class="btn btn-primary w-100 mx-auto" name="submit" value="Simpan pengubahan">
      </div>
    </div>
  </div>
</div>