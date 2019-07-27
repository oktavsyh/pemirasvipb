<?php
  include '../../../includes/dbh.inc.php';

  $sql = "SELECT file_foto FROM ".$_POST['tabel']." where id=".$_POST['nourut'];
  $hapusFoto = mysqli_query($conn, $sql);

  if($_POST['tabel'] == "paslon_bem_vokasi"){
    $folder = "vokasi";
  }
  elseif($_POST['tabel'] == "paslon_presma"){
    $folder = "presma";
  }
  elseif($_POST['tabel'] == "paslon_bem_psdku"){
    $folder = "psdku";
  }

  if($row = mysqli_fetch_assoc($hapusFoto)){
    unlink('../foto-paslon/'.$folder.'/'.$row['file_foto']);
  }

  $sql = "DELETE FROM ".$_POST['tabel']." where id=".$_POST['nourut'];
  mysqli_query($conn, $sql);

  echo "Data paslon berhasil dihapus!";