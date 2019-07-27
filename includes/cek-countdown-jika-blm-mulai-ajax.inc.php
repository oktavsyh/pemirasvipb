<?php
    session_start();

    include_once 'countdown.inc.php';
    countdown("mulai");

    if(isset($_SESSION['sisawaktu'])){
        if($_SESSION['sisawaktu'] > 0){
            echo "true";
            exit();
        }
    }

?>