<?php

  include '../../../includes/dbh.inc.php';

  $id = mysqli_escape_string($conn, $_POST['id']);
  $uname = mysqli_escape_string($conn, $_POST['uname']);
  $namatps = mysqli_escape_string($conn, $_POST['namatps']);
  $pwd = mysqli_escape_string($conn, $_POST['pwdbaru']);

  if($pwd != "")
    $sql = "UPDATE tps SET uname_tps = '$uname', pwd_tps = '$pwd', nama_tps = '$namatps' WHERE id = '$id'";
  else
    $sql = "UPDATE tps SET uname_tps = '$uname', nama_tps = '$namatps' WHERE id = '$id'";

  mysqli_query($conn, $sql);

  echo 'Akun TPS berhasil diperbarui!';