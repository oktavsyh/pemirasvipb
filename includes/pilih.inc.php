<?php

if(isset($_POST['pilih'])){
    session_start();
    include_once 'dbh.inc.php';

    $_SESSION['arrSdhVote'][] = $_POST['sdhvote'];

    $nim = $_SESSION['nim'];
    $pilih = mysqli_real_escape_string($conn, $_POST['pilih']);

    $tabelPaslonIni = $_POST['tabel'];

    $_SESSION['pilEnc'][$_POST['idx_vote']] = strtr(base64_encode($pilih), '+/=', '-_,');
    $_SESSION['tmp_vote'][$_POST['idx_vote']] = $pilih;

    // cari paslon yang memiliki id yang sesuai dengan paslon yg dipilih
    $sql = "SELECT * FROM $tabelPaslonIni WHERE id=$pilih";
    $paslonDipilih = mysqli_query($conn, $sql);
    if($rowPaslonDipilih = mysqli_fetch_assoc($paslonDipilih)){

        // update jumlah suara paslon
        $_SESSION['tmp_vote'][$_POST['idx_vote']] = $pilih;

        if(++$_SESSION['sdhvote'] == 3){
            $paslon = array(
                array("paslon_bem_vokasi", "vokasi"),
                array("paslon_presma", "presma"),
                array("paslon_bem_psdku", "psdku")
            );

            for($i = 0;$i < 3;$i++){
                $sql = "UPDATE ".$paslon[$i][0]." SET jml_suara= jml_suara + 1 WHERE id=".$_SESSION['tmp_vote'][$i];
                mysqli_query($conn, $sql);

                $sql = "UPDATE pemilih SET ".$paslon[$i][1]."='".$_SESSION['pilEnc'][$i]."' WHERE nim='$nim'";
                mysqli_query($conn, $sql);
            }

            // update status pemilih
            $sql = "UPDATE pemilih SET status='sdh' WHERE nim='$nim'";
            mysqli_query($conn, $sql);

            header("Location: ../votelogin.php?vote=sukses");
            exit();
        }
        else{
          header("Location: ../votemain");
          exit();
        }
    }
}
else{
    header("Location: ../index.php?tidak=kliksubmit");
    exit();
}
