<?php
  include_once 'includes/cek-countdown-jika-blm-mulai.inc.php';
  include_once 'includes/countdown-sampai-selesai-cek.inc.php';

  if(isset($_GET['logout'])){
    foreach($_SESSION as $key => $val) {
      if ($key !== 'sisawaktu') {
        unset($_SESSION[$key]);
      }
    }
  }

  if(isset($_SESSION['nama_tps'])){
      header("Location: votelogin.php");
      exit();
  }
?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Login TPS</title>

  <link rel="shortcut icon" href="favicon.jpg">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/style-login-admin-tps.css">
</head>

<body>
<div class="container">
  <div class="timer"></div>
  <div class="info">
    <h1>Login TPS</h1>
    <h2>E-Vote Pemira Vokasi IPB</h2>
  </div>
</div>
<div class="form">
  <div class="thumbnail"><img src="img/vote.png"/></div>
  <form class="login-form" action="includes/tpslogin.inc.php" method="post">
    <input type="text" name="un" placeholder="Username TPS"/>
    <input type="password" name="pw" placeholder="Password TPS"/>
    <button type="submit" name="submit">LOGIN</button><br>
    <br>
    <h5><?php
      if(isset($_GET['login'])){
        switch ($_GET['login']) {
          case "salah":
            echo "Username dan password tidak sesuai!";
            break;
          case "kosong":
            echo "Username dan password tidak boleh kosong!";
            break;
          case "blmlogin":
            echo "Anda harus login terlebih dahulu!";
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
