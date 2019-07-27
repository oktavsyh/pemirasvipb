<?php
    session_start();
    if(isset($_SESSION['uid']) && isset($_SESSION['pwd'])){
      header("Location: dashboard");
      exit();
    }
?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Login Admin</title>
    <link rel="shortcut icon" href="../favicon.jpg">
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="../css/style-login-admin-tps.css">

    <style>
        a{
            position: fixed;
            top: 0;
            left: 10px;
            text-decoration: none;
            color: black;
        }

        .form{
            margin-bottom: 0;
        }
    </style>

</head>

<body>

  
<div class="container">
    <div class="timer"></div>
  <div class="info">
    <h1>Selamat Datang</h1>
    <h2>Admin Pemira Vokasi IPB</h2>
  </div>
</div>
<div class="form">
  <div class="thumbnail"><img src="../img/admin.png"/></div>
  <form class="login-form" action="includes/login.inc.php" method="post">
    <input type="text" name="uid" placeholder="Username"/>
    <input type="password" name="pwd" placeholder="Password"/>
    <button type="submit" name="submit">LOGIN</button><br><br>
      <h5><?php
        if(isset($_GET['login']) && $_GET['login'] == "gagal"){
          echo "Username atau password salah!";
        }
        elseif(isset($_GET['login']) && $_GET['login'] == "blmlogin"){
          echo "Anda harus login terlebih dahulu!";
        }
        ?>
      </h5>
  </form>
</div>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>
<script src="../js/cek-dan-cetak-countdown-sampai-selesai.js"></script>

</body>

</html>
