<?php

include '../../../includes/dbh.inc.php';

$sql = "DELETE FROM ".$_POST['tabel'];
mysqli_query($conn, $sql);

echo "Semua data paslon berhasil dihapus!";