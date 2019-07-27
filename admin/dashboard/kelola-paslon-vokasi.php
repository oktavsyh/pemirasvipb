<?php
    include_once '../../includes/countdown.inc.php';
    countdown("mulai");

    if(isset($_SESSION['sisawaktu'])){
      if($_SESSION['sisawaktu'] < 1){
        header("Location: ../dashboard");
      }
    }
    include_once 'header-dan-panel-kiri.php';
    include '../../includes/dbh.inc.php';
?>
    <link rel="stylesheet" href="custom-file-input-and-list-group.css">
    <script>
        $('#kelola-paslon').toggleClass('active');
    </script>
    <script src="js/tanggal-pemira.js"></script>
    <script src="js/custom-file-input.js"></script>
    <script src="js/upload-paslon.js"></script>
    <script src="js/upload-paslon-vokasi.js"></script>
    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <div class="breadcrumbs">
            <div class="col-sm-12">
                <div class="page-header row">
                    <div class="page-title col-6">
                        <h1>Kelola Pasangan Calon</h1>
                    </div>
                    <div class="page-title col-6 text-right">
                        <h1 class="timer"></h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-5">
            <h3 class="text-center mb-3">Paslon Ketua BEM SV</h3>
            <form id="form-tambah-paslon" class="row" method="post" enctype="multipart/form-data">
                <div class="col-6">
                  <?php
                    include_once 'form-kelola-paslon.php'
                  ?>
                    <div class="form-group">
                        <center>
                            <input type="submit" class="btn btn-primary w-50" name="submit" value="Tambah Paslon">
                            <h5 id="status-tambah" class="status-upload mt-2"></h5>
                        </center>
                    </div>
                </div>
                <div class="col-6">
                    <div class="list-group"></div>
                    <div class="mt-3 form-group row">
                        <div class="col-6">
                            <center>
                                <button id="btn-ubah-data-paslon" type="button" class="btn btn-info w-100" data-toggle="modal" data-target="#modal-ubah-data-paslon">Ubah data paslon</button>
                            </center>
                        </div>
                        <div class="col-6">
                            <center>
                                <button id="btn-hapus-paslon" class="btn btn-warning w-100">Hapus data paslon</button>
                            </center>
                        </div>
                    </div>
                    <h5 class="status-hapus text-center mt-2"></h5>
                </div>
            </form>
            <center>
                <button id="btn-hapus-semua-paslon" class="btn btn-danger w-50 mt-3">Hapus semua paslon</button>
            </center>
        </div> <!-- .content -->
    </div><!-- /#right-panel -->
    <!-- Right Panel -->
    <div id="import-form-ubah-data-paslon"></div>
</body>
</html>
