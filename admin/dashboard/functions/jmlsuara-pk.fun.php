<?php
    include_once 'logincheck.fun.php';

    if($loginCheck){
        switch ($_POST['pk']){
            case "A":
                $pk = "Komunikasi";
                break;
            case "B":
                $pk = "Ekowisata";
                break;
            case "C":
                $pk = "Manajemen Informatika";
                break;
            case "D":
                $pk = "Teknik Komputer";
                break;
            case "E":
                $pk = "Supervisor Jaminan Mutu Pangan";
                break;
            case "F":
                $pk = "Manajemen Industri Jasa Makanan dan Gizi";
                break;
            case "G":
                $pk = "Teknologi Industri Benih";
                break;
            case "H":
                $pk = "Teknologi Produksi dan Manajemen Perikanan Budidaya";
                break;
            case "I":
                $pk = "Teknologi dan Manajemen Ternak";
                break;
            case "J":
                $pk = "Manajemen Agribisnis";
                break;
            case "K":
                $pk = "Manajemen Industri";
                break;
            case "L":
                $pk = "Analisis Kimia";
                break;
            case "M":
                $pk = "Teknik dan Manajemen Lingkungan";
                break;
            case "N":
                $pk = "Akuntansi";
                break;
            case "P":
                $pk = "Paramedik Veteriner";
                break;
            case "T":
                $pk = "Teknologi dan Manajemen Produksi Perkebunan";
                break;
            case "W":
                $pk = "Teknologi Produksi dan Pengembangan Masyarakat Pertanian";
        }

        $sql = "SELECT count(id) as total FROM ".$_POST['table'];
        $totPaslon = mysqli_query($conn, $sql);

        if($totPaslon = mysqli_fetch_assoc($totPaslon)){
            $totPaslon = $totPaslon['total'];
        }

        $arrSuara = array();
        for($i = 1;$i <= $totPaslon;$i++){
            $pilEncode = strtr(base64_encode($i), '+/=', '-_,');
            $sql = "SELECT count(nim) as tot FROM pemilih WHERE nim LIKE '__".$_POST['pk']."%' AND ".$_POST['field']."='$pilEncode'";
            $no = mysqli_query($conn, $sql);
            if($row = mysqli_fetch_assoc($no)){
                $arrSuara[$i-1] = $row['tot'];
            }
        }

        $sql = "SELECT * FROM ".$_POST['table'];
        $dataPaslon = mysqli_query($conn, $sql);
        $dataPaslonCheck = mysqli_num_rows($dataPaslon);

        if($dataPaslonCheck > 0){
            $i = 0;
            $arrPaslon = array();
            while ($row = mysqli_fetch_assoc($dataPaslon)) {
                //echo '<h4>'.$row['id'].'. '.$row['nama_paslon'].' : '.$arr[$i].' suara</h4><br>';
                $arrPaslon[$i] = array($row['id'].'. '.$row['nama_paslon'].' : '.$arrSuara[$i].' suara', (int)$arrSuara[$i]);
                $i++;
            }

            $sql = "SELECT count(status) as blmvote FROM pemilih WHERE status='blm' AND nim LIKE '__".$_POST['pk']."%'";
            $blmvote = mysqli_query($conn, $sql);
            if($row = mysqli_fetch_assoc($blmvote)){
                $arrPaslon[$i] = array("Belum vote : ".$row['blmvote']." suara", (int)$row['blmvote']);
            }

            echo json_encode($arrPaslon);
        }
    }
?>
