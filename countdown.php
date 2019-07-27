<?php
    session_start();
    include_once 'includes/countdown-sampai-mulai-cek.inc.php'
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Countdown - PEMIRA</title>
    <link rel="shortcut icon" href="favicon.jpg">
    <link rel="stylesheet" href="countdown-blm-mulai.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="countdown-blm-mulai.js"></script>

</head>
<body>
    <h1 style="text-align: center; margin-top: 190px;">Countdown E-Vote PEMIRA</h1>
    <div id="countdown">
        <div id='tiles'></div>
        <div class="labels">
            <li>Hari</li>
            <li>Jam</li>
            <li>Menit</li>
            <li>Detik</li>
        </div>
    </div>
</body>
</html>
