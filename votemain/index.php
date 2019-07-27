<?php
    include_once '../includes/cek-countdown-jika-blm-mulai.inc.php';
    include_once '../includes/countdown-sampai-selesai-cek.inc.php';


    if(!isset($_SESSION['nim'])){
      header("Location: ../votelogin.php?login=blmlogin");
      exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Menu Utama - PEMIRA</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="../vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="../css/landing-page.min.css" rel="stylesheet">
    <link href="../css/style-votepaslon.css" rel="stylesheet">

      <!-- Bootstrap core JavaScript -->
      <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
      <script src="cek-dan-cetak-countdown-sampai-selesai.js"></script>

  </head>

  <body>

    <header class="jumbotron">
      <div class="container">
        <div class="row">
            <h6 class="col-12 timer"></h6>
          <div class="col-xl-9 mx-auto">
            <h1>Selamat Datang!</h1>
            <h2><?php
              echo $_SESSION['nama'];
              ?></h2>
            <h3><?php
              echo $_SESSION['pk'];
              ?></h3>
          <h3><?php
            echo $_SESSION['nim'];
            ?></h3>
          </div>
        </div>
      </div>
    </header>


    <!-- Icons Grid -->
    <section class="features-icons bg-light text-center">
      <div class="container">
        <div class="row">
            <div <?php
                switch ($_SESSION['sdhvote']) {
                  case 1:
                    echo 'class="col-lg-6"';
                    break;
                  case 2:
                    echo 'class="col-lg-12"';
                    break;
                  default:
                    echo 'class="col-lg-4"';
                    break;
                }
                if(isset($_SESSION['arrSdhVote']) && in_array("presma", $_SESSION['arrSdhVote'])){
                    echo ' style="display: none;"';
                }
            ?>>
            <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
              <div class="features-icons-icon d-flex">
                <i class="icon-people m-auto text-primary"></i>
              </div>
                <form method="post">
                    <a href="javascript:;" onclick="parentNode.submit();"> <h3>Presiden Mahasiswa IPB</h3> </a>
                    <input type="hidden" name="menu" value="presma"/>
                    <input type="hidden" name="tabel" value="paslon_presma"/>
                </form>
            </div>
          </div>
          <div <?php
              switch ($_SESSION['sdhvote']) {
                case 1:
                  echo 'class="col-lg-6"';
                  break;
                case 2:
                  echo 'class="col-lg-12"';
                  break;
                default:
                  echo 'class="col-lg-4"';
                  break;
              }

              if(isset($_SESSION['arrSdhVote']) && in_array("vokasi", $_SESSION['arrSdhVote'])){
                echo ' style="display: none;"';
              }
          ?>>
            <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
              <div class="features-icons-icon d-flex">
                <i class="icon-people m-auto text-primary"></i>
              </div>
                <form method="post">
                    <a href="javascript:;" onclick="parentNode.submit();"> <h3>Ketua BEM SV IPB</h3> </a>
                    <input type="hidden" name="menu" value="vokasi"/>
                    <input type="hidden" name="tabel" value="paslon_bem_vokasi"/>
                </form>
            </div>
        </div>
            <div <?php
                switch ($_SESSION['sdhvote']) {
                  case 1:
                    echo 'class="col-lg-6"';
                    break;
                  case 2:
                    echo 'class="col-lg-12"';
                    break;
                  default:
                    echo 'class="col-lg-4"';
                    break;
                }

                if(isset($_SESSION['arrSdhVote']) && in_array("psdku", $_SESSION['arrSdhVote'])){
                  echo ' style="display: none;"';
                }
            ?>>
                <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                    <div class="features-icons-icon d-flex">
                        <i class="icon-people m-auto text-primary"></i>
                    </div>
                    <form method="post">
                        <a href="javascript:;" onclick="parentNode.submit();"> <h3>Ketua BEM SV PSDKU IPB</h3> </a>
                        <input type="hidden" name="menu" value="psdku"/>
                        <input type="hidden" name="tabel" value="paslon_bem_psdku"/>
                    </form>
                </div>
            </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="footer bg-dark" style="padding: 6.5vh 0;">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 h-100 text-center my-auto">
            <p class="text-center text-white">&copy; Berkah Studio 2018. All Rights Reserved.</p>
          </div>
        </div>
      </div>
    </footer>

    <?php
    if(isset($_POST['menu'])){
      if($_POST['menu'] == "vokasi"){
        header("Location: ../votebemvokasi");
      }
      elseif($_POST['menu'] == "presma"){
        header("Location: ../votepresma");
      }
      elseif($_POST['menu'] == "psdku"){
        header("Location: ../votebempsdku");
      }
      if(!isset($_SESSION['sdhvote'])){
        $_SESSION['sdhvote'] = 0;
        $_SESSION['pilEnc'] = array();
        $_SESSION['menu'] = $_POST['menu'];
        $_SESSION['tmp_vote'] = array();
        $_SESSION['idx_vote'] = 0;
        exit();
      }
    }
    ?>

  </body>

</html>
