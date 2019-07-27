<?php

include_once 'countdown.inc.php';
include_once 'ceklink.inc.php';
countdown("mulai");

if(isset($_SESSION['sisawaktu'])){
    if($_SESSION['sisawaktu'] < 1){
        session_unset();
        session_destroy();
        header("Location: ".cekLink("index.php"));
        exit();
    }
}