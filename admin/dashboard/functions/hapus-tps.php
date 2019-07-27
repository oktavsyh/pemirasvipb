<?php

include '../../../includes/dbh.inc.php';

$sql = "DELETE FROM tps where id = ".$_POST['id'];
mysqli_query($conn, $sql);

echo 'Akun TPS berhasil dihapus!';