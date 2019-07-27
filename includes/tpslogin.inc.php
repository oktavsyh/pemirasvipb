<?php
include 'dbh.inc.php';

if(isset($_POST['submit'])){
  session_start();

  $un = $_POST['un'];
  $pw = $_POST['pw'];

  if(empty($un) || empty($pw)){
    header("Location: ../index.php?login=kosong");
    exit();
  }

  $sql = "SELECT * FROM tps WHERE uname_tps = '$un' AND pwd_tps = '$pw';";
  $tps = mysqli_query($conn, $sql);

  if($row = mysqli_fetch_assoc($tps)){
    $_SESSION['nama_tps'] = $row['nama_tps'];
    header("Location: ../votelogin.php");
  }
  else{
    header("Location: ../index.php?login=salah");
  }
  exit();
}