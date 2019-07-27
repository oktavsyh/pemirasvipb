<?php

if(isset($_POST['submit'])){
    session_start();
    include_once '../../../includes/dbh.inc.php';

    function random_str($length, $keyspace = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'){
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[mt_rand(0, $max)];
        }
        return implode('', $pieces);
    }

    $nim = mysqli_real_escape_string($conn, $_POST['nim']);
    if(empty($nim)){
        echo '<h5 class="text-center">NIM tidak boleh kosong!</h5>';
        exit();
    }
    else{
        $sql = "SELECT * FROM pemilih WHERE nim='$nim'";
        $nimCek = mysqli_query($conn, $sql);
        if($row = mysqli_fetch_assoc($nimCek)){
            $_SESSION['token'] = random_str(6);
            $sql = "UPDATE pemilih SET token='".$_SESSION['token']."' WHERE nim='".$nim."'";
            mysqli_query($conn, $sql);
            echo '<h5 class="text-center">Token : '.$_SESSION['token'].'</h5>';
        }
        else {
            echo '<h5 class="text-center">NIM tidak ditemukan!</h5>';
            exit();
        }
    }
}
