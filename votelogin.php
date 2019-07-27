<?php
    include_once 'includes/cek-countdown-jika-blm-mulai.inc.php';
    include_once 'includes/countdown-sampai-selesai-cek.inc.php';
    foreach($_SESSION as $key => $val) {
        if ($key !== 'sisawaktu' && $key !== 'nama_tps') {
            unset($_SESSION[$key]);
        }
    }

    if(!isset($_SESSION['nama_tps'])){
        header("Location: index.php?login=blmlogin");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <title>Login Pemilih</title>

    <link rel="shortcut icon" href="favicon.jpg">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

    <link rel="stylesheet" href="css/style.css">

    <style>
        a{
            position: fixed;
            top: 0;
            left: 10px;
            text-decoration: none;
            color: black;
        }

        .container .info{
            margin: 20px auto;
        }
    </style>
</head>

<body>
<div class="container">
    <a href="index.php?logout=tps">LOG OUT TPS</a>
    <div class="timer"></div>
    <div class="tps">
        <h1 style="text-align: center; margin-top: 10px; font-size: 16pt;">
          <?php
            echo "TPS - ".strtoupper($_SESSION['nama_tps']);
          ?>
        </h1>
    </div>
    <div class="info">
        <h1>Selamat Datang</h1>
        <h2>Di E-Vote Pemira Vokasi IPB</h2>
    </div>
</div>
<div class="form">
    <div class="thumbnail"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/hat.svg"/></div>
    <form class="login-form" action="includes/login.inc.php" method="post">
        <input type="text" name="nim" placeholder="Masukkan NIM Anda"/>
        <input type="password" name="token" placeholder="Masukkan Token"/>
        <button type="submit" name="submit">LOG IN</button><br>
        <br>
        <h5><?php
          if(isset($_GET['login'])){
            switch ($_GET['login']) {
              case "salah":
                echo "NIM dan token tidak sesuai!";
                break;
              case "kosong":
                echo "NIM dan token tidak boleh kosong!";
                break;
              case "blmlogin":
                echo "Anda harus login terlebih dahulu!";
            }
          }
          elseif(isset($_GET['vote'])){
            switch ($_GET['vote']) {
              case "sudahmemilih":
                echo "Anda sudah menggunakan hak pilih anda!";
                break;
              case "sukses":
                echo "Vote sukses!";
                break;
            }
          }
          ?></h5>
    </form>
</div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>
<script src="js/cek-dan-cetak-countdown-sampai-selesai.js"></script>

</body>

</html>
