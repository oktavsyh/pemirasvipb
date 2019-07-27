<?php
    session_start();
    include_once 'ceklink.inc.php';
    include_once 'countdown.inc.php';

    countdown("mulai");

    if(isset($_SESSION['sisawaktu'])){
        if($_SESSION['sisawaktu'] > 0){
            session_unset();
            session_destroy();
            header("Location: ".cekLink("countdown.php"));
            exit();
        }
    }

?>