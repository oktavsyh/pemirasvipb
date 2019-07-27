<?php

include "../../../includes/dbh.inc.php";

$sql = "SELECT * FROM tps WHERE id = ".$_POST['id'];
$rslt = mysqli_query($conn, $sql);
$tps = mysqli_fetch_assoc($rslt);

echo $tps['pwd_tps'];