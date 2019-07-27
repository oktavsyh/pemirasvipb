<?php
    include_once '../../includes/countdown.inc.php';
    countdown("mulai");

    include_once 'header-dan-panel-kiri.php';
    include '../../includes/dbh.inc.php';
?>
    <link rel="stylesheet" href="custom-file-input-and-list-group.css">
    <script>
        $('#kelola-paslon').toggleClass('active');
    </script>
    <script src="js/tanggal-pemira.js"></script>
    <script src="js/custom-file-input.js"></script>
    <script src="js/upload-tps.js"></script>
    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <div class="breadcrumbs">
            <div class="col-sm-12">
                <div class="page-header row">
                    <div class="page-title col-6">
                        <h1>Kelola TPS</h1>
                    </div>
                    <div class="page-title col-6 text-right">
                        <h1 class="timer"></h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-5">
            <form id="form-tambah-paslon" class="row" method="post" enctype="multipart/form-data">
                <div class="col-6">
                    <div class="form-group row pt-5">
                        <label for="uname" class="col-sm-3 col-form-label">Username TPS</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="uname">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="namatps" class="col-sm-3 col-form-label">Nama TPS</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="namatps">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pwd" class="col-sm-3 col-form-label">Password TPS</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="pwd">
                        </div>
                    </div>
                    <div class="form-group">
                        <center>
                            <input type="submit" class="btn btn-primary w-50" name="submit" value="Tambah TPS">
                            <h5 id="status-tambah" class="status-upload mt-2"></h5>
                        </center>
                    </div>
                </div>
                <div class="col-6">
                    <div class="list-group"></div>
                    <div class="mt-3 form-group row">
                        <div class="col-6">
                            <center>
                                <button id="btn-ubah-data-tps" type="button" class="btn btn-info w-100" data-toggle="modal" data-target="#modal-ubah-data-tps">Ubah akun TPS</button>
                            </center>
                        </div>
                        <div class="col-6">
                            <center>
                                <button id="btn-hapus-tps" class="btn btn-warning w-100">Hapus akun TPS</button>
                            </center>
                        </div>
                    </div>
                    <h5 class="status-hapus text-center mt-2"></h5>
                </div>
            </form>
            <center>
                <button id="btn-hapus-semua-tps" class="btn btn-danger w-50 mt-3">Hapus semua akun TPS</button>
            </center>
        </div> <!-- .content -->
    </div><!-- /#right-panel -->
    <!-- Right Panel -->
    <div id="import-form-ubah-data-tps"></div>
</body>
</html>