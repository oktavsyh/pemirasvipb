<?php
    session_start();

    $loginCheck = isset($_SESSION['uid']) && isset($_SESSION['pwd']);

    if($loginCheck){
        include_once '../../../includes/dbh.inc.php';
    }
    else{
        header("Location: ../index.php");
        exit();
    }
