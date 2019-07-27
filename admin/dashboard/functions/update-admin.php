<?php

include '../../../includes/dbh.inc.php';

$sql = "SELECT * FROM admin;";
$rslt = mysqli_query($conn, $sql);
$admin = mysqli_fetch_assoc($rslt);

if(isset($_POST['submit'])){
  if(empty($_POST['oldpwd']) || empty($_POST['newpwd'])){
    echo '<h5>Password tidak boleh kosong!</h5>';
  }
  else{
    if( md5($_POST['oldpwd']) == $admin['admin_pwd']){
      $sql = "UPDATE admin SET admin_uid = '".$_POST['uname']."', admin_pwd = '".md5($_POST['newpwd'])."'";
      mysqli_query($conn, $sql);
      echo '<h5>Pengubahan telah disimpan!</h5>';
    }
    else{
      echo '<h5>Password lama salah!</h5>';
    }
  }
}