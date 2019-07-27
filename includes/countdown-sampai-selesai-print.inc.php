<?php

//You must call the function session_start() before
//you attempt to work with sessions in PHP!
include_once 'dbh.inc.php';

//Set the countdown
$sql = "SELECT TIMESTAMPDIFF(SECOND, NOW(), selesai) AS durasi FROM waktu";
$waktu = mysqli_query($conn, $sql);

if($row = mysqli_fetch_assoc($waktu)){
    $_SESSION['countdown'] = $row['durasi'];
}
//Store the timestamp of when the countdown began.
$_SESSION['time_started'] = time();


//Get the current timestamp.
$now = time();

//Calculate how many seconds have passed since
//the countdown began.
$timeSince = $now - $_SESSION['time_started'];

//How many seconds are remaining?
$remainingSeconds = $_SESSION['countdown'] - $timeSince;

$_SESSION['sisawaktu'] = $remainingSeconds;

$hari = (int)($remainingSeconds / 86400); $remainingSeconds -= 86400 * $hari;
$jam = (int)($remainingSeconds / 3600); $remainingSeconds -= 3600 * $jam;
$menit = (int)($remainingSeconds / 60); $remainingSeconds -= 60 * $menit;

if($jam < 10){
  $jam = '0'.$jam;
}
if($menit < 10){
  $menit = '0'.$menit;
}
if($remainingSeconds < 10){
  $remainingSeconds = '0'.$remainingSeconds;
}
//Print out the countdown.
if($_SESSION['sisawaktu'] > 0){
    echo "Voting sedang berlangsung - $jam:$menit:$remainingSeconds";
}
else{
    echo "Voting Selesai";
}