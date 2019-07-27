<?php
    include '../../includes/dbh.inc.php';
    if(isset($_POST['nourut'])){
      $sql = "SELECT * FROM ".$_POST['tabel']." WHERE id=".$_POST['nourut'];
      $dataPaslon = mysqli_query($conn, $sql);
    }
?>
<div id="modal-ubah-data-paslon" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #e2e2e2">
        <div class="col-4"></div>
        <h5 class="modal-title">Ubah Data Paslon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="background-color: #e2e2e2">
        <form id="form-ubah-data-paslon" method="post" enctype="multipart/form-data">
          <?php
            include 'form-kelola-paslon.php';
          ?>
        </form>
          <h5 class="status-upload text-center"></h5>
      </div>
      <div class="modal-footer" style="background-color: #e2e2e2">
          <input id="btn-simpan-ubah-data-paslon" type="submit" form="form-ubah-data-paslon" class="btn btn-primary w-100 mx-auto" name="submit" value="Simpan pengubahan">
      </div>
    </div>
  </div>
</div>