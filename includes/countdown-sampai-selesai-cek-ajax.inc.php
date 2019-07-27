<?php
    session_start();
    include_once 'countdown.inc.php';
    countdown("selesai");

    if(isset($_SESSION['sisawaktu'])) {
        if ($_SESSION['sisawaktu'] < 1) {
            echo "true";
        }
    }