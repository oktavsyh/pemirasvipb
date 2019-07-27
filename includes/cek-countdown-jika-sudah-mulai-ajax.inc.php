<?php
    session_start();
    include_once 'countdown.inc.php';
    countdown("mulai");

    if(isset($_SESSION['sisawaktu'])){
        if($_SESSION['sisawaktu'] < 1){
            session_unset();
            session_destroy();
            echo "true";
        }
        else{
            echo "false";
        }
    }