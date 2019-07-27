<?php

include_once 'countdown.inc.php';
include_once 'ceklink.inc.php';
countdown("selesai");
if(isset($_SESSION['sisawaktu'])) {
    if ($_SESSION['sisawaktu'] < 0) {
        session_unset();
        session_destroy();
        header("Location: ".cekLink("votingselesai.php"));
    }
}