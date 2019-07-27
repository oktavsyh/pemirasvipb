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
                        <h1>Total Suara Keseluruhan</h1>
                    </div>
                    <div class="page-title col-6 text-right">
                        <h1 class="timer"></h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3" style="overflow: auto; height: 85vh;">
            <div id="chart-vokasi-tot" class="mb-4"></div>
            <div id="chart-presma-tot" class="mb-4"></div>
            <div id="chart-psdku-tot" class="mb-4"></div>
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
</body>
</html>
