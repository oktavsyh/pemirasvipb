<?php
    include_once 'header-dan-panel-kiri.php';
    include '../../includes/dbh.inc.php';

    $sql = "SELECT * FROM waktu";
    $tgl_pemira = mysqli_query($conn, $sql);
?>
    <script>
        $('#atur-jadwal-sistem').toggleClass('active');
    </script>
    <script src="js/tanggal-pemira.js"></script>
    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <div class="breadcrumbs">
            <div class="col-sm-12">
                <div class="page-header row">
                    <div class="page-title col-6">
                        <h1>Atur Jadwal Sistem</h1>
                    </div>
                    <div class="page-title col-6 text-right">
                        <h1 class="timer"></h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <form id="tanggal-pemira" class="mt-5">
                <center>
                    <div class="form-group">
                        <label for="tglmulai" class="col-form-label text-center">Tanggal Mulai</label>
                        <input type="date" class="form-control w-50" id="tglmulai" name="tglmulai" value="<?php
                            if($row = mysqli_fetch_assoc($tgl_pemira)){
                                echo substr($row['mulai'], 0, 10);
                            }
                        ?>">
                    </div>
                    <div class="form-group">
                        <label for="pklmulai" class="col-form-label text-center my-auto">Jam Mulai</label>
                        <input type="time" class="form-control w-50" id="pklmulai" name="pklmulai" value="<?php
                            echo substr($row['mulai'], 11, 5);
                        ?>">
                    </div>
                    <div class="form-group">
                        <label for="pklselesai" class="col-form-label text-center my-auto">Jam Selesai</label>
                        <input type="time" class="form-control w-50" id="pklselesai" name="pklselesai" value="<?php
                            echo substr($row['selesai'], 11, 5);
                        ?>">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success w-25">Simpan</button>
                    </div>
                </center>
            </form>
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
</body>
</html>
