<?php
  include_once 'header-dan-panel-kiri.php';
  include '../../includes/dbh.inc.php';

  $sql = "SELECT * FROM admin;";
  $rslt = mysqli_query($conn, $sql);
  $admin = mysqli_fetch_assoc($rslt);
?>
<script>
    $('#kelola-akun').toggleClass('active');
</script>
<script src="js/tanggal-pemira.js"></script>
<!-- Right Panel -->

<style>
  .form-control{
    margin-bottom: 20px;
  }

  .content{
    padding: 15vh 0;
  }

</style>

<div id="right-panel" class="right-panel">

  <div class="breadcrumbs">
    <div class="col-sm-12">
      <div class="page-header row">
        <div class="page-title col-6">
          <h1>Ganti Username dan Password Admin</h1>
        </div>
        <div class="page-title col-6 text-right">
          <h1 class="timer"></h1>
        </div>
      </div>
    </div>
  </div>

  <div class="content mt-3">
    <form id="form-admin" method="POST" >
      <center>
        <div class="form-group">
          <label for="uname">Username :</label>
          <input type="text" class="form-control w-50" name="uname" value="<?php echo $admin['admin_uid']; ?>">
          <label for="oldpwd">Password lama :</label>
          <input type="password" class="form-control w-50" name="oldpwd">
          <label for="newpwd">Password baru :</label>
          <input type="password" class="form-control w-50" name="newpwd">
        </div>
        <div class="form-group">
          <button id="btn-admin" class="btn btn-primary w-25" type="submit">Simpan perubahan</button>
        </div>
        <div id="status-update-admin" class="form-group">

        </div>
      </center>
    </form>
  </div> <!-- .content -->
</div><!-- /#right-panel -->

<!-- Right Panel -->
</body>
</html>
