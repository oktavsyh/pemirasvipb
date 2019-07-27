<?php
  include '../../../includes/dbh.inc.php';
  $sql = "SELECT * FROM ".$_POST['tabel'];
  $listPaslon = mysqli_query($conn, $sql);

  while($row = mysqli_fetch_assoc($listPaslon)){
    echo '<a href="#" class="list-group-item list-group-item-action">'.$row['id'].'. '.$row['nama_paslon'].'</a>';
  }

  if(!mysqli_num_rows($listPaslon)){
    echo '<li class="list-group-item disabled text-center" style="background-color: #eaeaea; border: none;">Tidak ada data paslon</a>';
  }
?>