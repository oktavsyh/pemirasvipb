<?php
include_once '../../../includes/dbh.inc.php';

$sql = "UPDATE waktu SET mulai='".$_POST['tglmulai']." ".$_POST['pklmulai'].":00', selesai='".$_POST['tglmulai']." ".$_POST['pklselesai'].":00'";
mysqli_query($conn, $sql);