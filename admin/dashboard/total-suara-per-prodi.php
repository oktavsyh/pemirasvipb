<?php
    include_once 'header-dan-panel-kiri.php';
?>
    <script>
        $('#total-suara').toggleClass('active');
    </script>
    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <div class="breadcrumbs">
            <div class="col-sm-12">
                <div class="page-header row">
                    <div class="page-title col-6">
                        <h1>Total Suara per Program Studi</h1>
                    </div>
                    <div class="page-title col-6 text-right">
                        <h1 class="timer"></h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <center><select class="form-control mb-4 w-50"></select></center>
            <div style="height: 75vh; overflow: auto">
                <div id="chart-vokasi-per-pk" class="text-center mb-4"></div>
                <div id="chart-presma-per-pk" class="text-center mb-4"></div>
                <div id="chart-psdku-per-pk" class="text-center"></div>
            </div>
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
</body>
</html>
