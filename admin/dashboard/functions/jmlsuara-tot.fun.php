<?php
    include_once 'logincheck.fun.php';
    
    if($loginCheck){
        $sql = "SELECT * FROM ".$_POST['table'];
        $dataPaslon = mysqli_query($conn, $sql);
        $dataPaslonCheck = mysqli_num_rows($dataPaslon);

        $arrPaslon = array();
        if($dataPaslonCheck > 0){
            $i = 0;
            while ($row = mysqli_fetch_assoc($dataPaslon)) {
                $arrPaslon[$i] = array($row['id'].'. '.$row['nama_paslon'].' : '.$row['jml_suara'].' suara', (int)$row['jml_suara']);
                $i++;
            }

            $sql = "SELECT count(status) as blmvote FROM pemilih WHERE status='blm'";
            $blmvote = mysqli_query($conn, $sql);
            if($row = mysqli_fetch_assoc($blmvote)){
                $arrPaslon[$i] = array("Belum vote : ".$row['blmvote']." suara", (int)$row['blmvote']);
            }

            echo json_encode($arrPaslon);
        }
    }
?>
