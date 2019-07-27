<?php

include '../../../includes/dbh.inc.php';

$sql = "DELETE FROM tps;";
mysqli_query($conn, $sql);

echo "Semua data TPS berhasil dihapus!";