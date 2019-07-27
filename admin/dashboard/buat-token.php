<?php
    include_once 'header-dan-panel-kiri.php';
?>
    <script>
        $('#buat-token').toggleClass('active');
    </script>
    <script src="js/tanggal-pemira.js"></script>
    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <div class="breadcrumbs">
            <div class="col-sm-12">
                <div class="page-header row">
                    <div class="page-title col-6">
                        <h1>Buat Token</h1>
                    </div>
                    <div class="page-title col-6 text-right">
                        <h1 class="timer"></h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <br><br><br><br><br><br>
            <form id="form-token" method="POST" >
                <center>
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control w-50" name="nim">
                    </div>
                    <div class="form-group">
                        <button id="btn-token" class="btn btn-primary w-25" type="submit">Buat token</button>
                    </div>
                    <div id="status-buat-token" class="form-group"><?php
                      if(isset($_GET['nim']) && $_GET['nim'] == "kosong"){
                        echo "<h5>NIM tidak boleh kosong!</h5>";
                      }
                      ?>
                    </div>
                </center>
            </form>
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
</body>
</html>
