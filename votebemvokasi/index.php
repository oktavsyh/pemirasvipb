<?php
    include_once '../includes/cek-countdown-jika-blm-mulai.inc.php';
    include_once '../includes/countdown-sampai-selesai-cek.inc.php';

    if(!isset($_SESSION['nim'])){
      header("Location: ../votelogin.php?login=blmlogin");
      exit();
    }
    else{
        include '../includes/dbh.inc.php';
        $sql = "SELECT * FROM paslon_bem_vokasi";
        $dataPaslon = mysqli_query($conn, $sql);
        $dataPaslonCheck = mysqli_num_rows($dataPaslon);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Vote Calon Presiden Mahasiswa IPB</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
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
              <h1 class="mb-12">Vote Calon Ketua BEM SV</h1>
              <h2 class="mb-12"><?php
                echo $_SESSION['nama'];
                ?></h2>
              <h3 class="mb-12"><?php
                echo $_SESSION['pk'];
                ?></h3>
              <h3 class="mb-12"><?php
                echo $_SESSION['nim'];
                ?></h3>
          </div>
        </div>
      </div>
    </header>


    <!-- Icons Grid -->
    <section class="features-icons bg-light text-center container-fluid">
      <div class="row text-center">

        <?php
        if($dataPaslonCheck > 0){
          while($row = mysqli_fetch_assoc($dataPaslon)){
            echo '<div class="col-lg-4 col-md-6 mb-4">
                          <div class="card" style="min-height: 500px;">
                            <img class="card-img-top" src="../admin/dashboard/foto-paslon/vokasi/'.$row['file_foto'].'" alt="">
                            <div class="card-body">
                              <h4 class="card-title">'.$row['nama_paslon'].'</h4>
                              <p class="card-text">'.$row['deskripsi'].'</p>
                            </div>
                            <div class="card-footer">
                                <form action="../includes/pilih.inc.php" method="post">
                                    <button class="btn btn-primary" type="submit" name="pilih" value="'.$row['id'].'">Pilih paslon ini</button>
                                    <input type="hidden" name="tabel" value="paslon_bem_vokasi">
                                    <input type="hidden" name="idx_vote" value="0">
                                    <input type="hidden" name="sdhvote" value="vokasi">
                                </form>
                            </div>
                          </div>
                        </div>';
          }
        }
        ?>

      </div>
    </section>

    <!-- Footer -->
    <footer class="footer bg-dark">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 h-100 text-center my-auto">
            <p class="text-center text-white">&copy; Berkah Studio 2018. All Rights Reserved.</p>
          </div>
        </div>
      </div>
    </footer>

  </body>

</html>
