<?php
  include '../../../includes/dbh.inc.php';

  $sql = "SELECT * FROM tps;";
  $rslt = mysqli_query($conn, $sql);

  $id = mysqli_num_rows($rslt) + 1;
  $uname = mysqli_escape_string($conn, $_POST['uname']);
  $namatps = mysqli_escape_string($conn, $_POST['namatps']);
  $pwd = mysqli_escape_string($conn, $_POST['pwd']);

  $sql = "INSERT INTO tps VALUES ($id, '$uname', '$pwd', '$namatps')";
  mysqli_query($conn, $sql);

  echo 'Akun TPS berhasil ditambah!';