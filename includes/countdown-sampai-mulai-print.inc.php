<?php

//You must call the function session_start() before
//you attempt to work with sessions in PHP!
session_start();

include_once 'countdown.inc.php';
countdown("mulai");

$hari = (int)($_SESSION['sisawaktu'] / 86400); $remainingSeconds = $_SESSION['sisawaktu'] - 86400 * $hari;
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
  echo "Voting belum dimulai - $hari:$jam:$menit:$remainingSeconds";
}