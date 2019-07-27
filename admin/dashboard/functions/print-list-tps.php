<?php
  include '../../../includes/dbh.inc.php';
  $sql = "SELECT * FROM tps;";
  $listTPS = mysqli_query($conn, $sql);

  while($row = mysqli_fetch_assoc($listTPS)){
    echo '<a href="#" class="list-group-item list-group-item-action">'.$row['id'].'. '.$row['nama_tps'].'</a>';
  }

  if(!mysqli_num_rows($listTPS)){
    echo '<li class="list-group-item disabled text-center" style="background-color: #eaeaea; border: none;">Tidak ada akun TPS</a>';
  }
?>