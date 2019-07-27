<?php
    session_start();
    if(!isset($_SESSION['uid']) && !isset($_SESSION['pwd'])){
      header("Location: ../index.php?login=blmlogin");
      exit();
    }
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin - PEMIRA</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="../../favicon.jpg">

  <link rel="stylesheet" href="assets/css/normalize.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/themify-icons.css">
  <link rel="stylesheet" href="assets/css/flag-icon.min.css">
  <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
  <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
  <link rel="stylesheet" href="assets/scss/style.css">

  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

  <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
  <script src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="assets/js/plugins.js"></script>

  <script src="js/chart-dan-token-pemira.js"></script>
  <script src="js/cetak-countdown.js"></script>
</head>
<body>

<!-- Left Panel -->

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="./">Admin PEMIRA</a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li id="total-suara" class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-check-square"></i>Total Suara</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><a href="./">Keseluruhan</a></li>
                        <li><a href="total-suara-per-prodi.php">Per Program Studi</a></li>
                    </ul>
                </li>

                <li id="kelola-akun" class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Kelola Akun</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><a href="kelola-admin.php">Admin</a></li>
                        <li><a href="kelola-tps.php">TPS</a></li>
                    </ul>
                </li>

                <li id="atur-jadwal-sistem" class="sub-menu">
                    <a href="atur-jadwal-sistem.php"> <i class="menu-icon fa fa-calendar"></i>Atur Jadwal Sistem</a>
                </li>

                <li id="kelola-paslon" class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Kelola Paslon</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><a href="kelola-paslon-vokasi.php">Ketua BEM SV IPB</a></li>
                        <li><a href="kelola-paslon-presma.php">Presma IPB</a></li>
                        <li><a href="kelola-paslon-psdku.php">Ketua BEM SV PSDKU IPB</a></li>
                    </ul>
                </li>

                <li id="buat-token" class="sub-menu">
                    <a href="buat-token.php"><i class="menu-icon fa fa-code"></i>Buat Token</a>
                </li>

                <li id="download-laporan" class="sub-menu">
                    <a href="#" id="downloadlaporan"> <i class="menu-icon fa fa-download"></i>Download Hasil Vote</a>
                </li>

                <li id="log-out" class="sub-menu">
                    <a href="#" id="logout"> <i class="menu-icon fa fa-sign-out"></i>Log Out</a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->

<!-- Left Panel -->