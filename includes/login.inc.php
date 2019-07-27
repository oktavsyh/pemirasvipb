<?php

if(isset($_POST['submit'])){
    session_start();
    include_once 'dbh.inc.php';

    $nim = mysqli_real_escape_string($conn, strtoupper($_POST['nim']));
    $token = mysqli_real_escape_string($conn, strtoupper($_POST['token']));

    // cek jika input text masih kosong
    if(empty($nim) || empty($token)){
        header("Location: ../votelogin.php?login=kosong");
        exit();
    }
    else{
        // cari data pemilih
        $sql = "SELECT * FROM pemilih WHERE nim='$nim' AND token='$token'";
        $pemilih = mysqli_query($conn, $sql);

        //jika data pemilih ada dalam database
        if(mysqli_num_rows($pemilih) > 0){
            if($row = mysqli_fetch_assoc($pemilih)){
                if($row['status'] == "sdh"){
                    header("Location: ../votelogin.php?vote=sudahmemilih");
                    exit();
                }
                else{
                    $_SESSION['nim'] = $row['nim'];
                    $_SESSION['nama'] = $row['nama'];

                    $kodePK = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","P","T","W"];
                    $namaPK = [
                        "Komunikasi",
                        "Ekowisata",
                        "Manajemen Informatika",
                        "Teknik Komputer",
                        "Supervisor Jaminan Mutu Pangan",
                        "Manajemen Industri Jasa Makanan dan Gizi",
                        "Teknologi Industri Benih",
                        "Teknologi Produksi dan Manajemen Perikanan Budidaya",
                        "Teknologi dan Manajemen Ternak",
                        "Manajemen Agribisnis",
                        "Manajemen Industri",
                        "Analisis Kimia",
                        "Teknik dan Manajemen Lingkungan",
                        "Akuntansi",
                        "Paramedik Veteriner",
                        "Teknologi dan Manajemen Produksi Perkebunan",
                        "Teknologi Produksi dan Pengembangan Masyarakat Pertanian"
                    ];

                    for($i = 0;$i < count($kodePK);$i++){
                        if(substr($nim, 2, 1) == $kodePK[$i]){
                            $_SESSION['pk'] = $namaPK[$i];
                            break;
                        }
                    }

                    $_SESSION['sdhvote'] = 0;
                    header("Location: ../votemain");
                    exit();
                }
            }
        }
        else{
            // jika tidak ada
            header("Location: ../votelogin.php?login=salah");
            exit();
        }
    }
}
