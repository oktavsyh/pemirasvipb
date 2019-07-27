<?php
if(isset($_POST['submit'])){
    session_start();
    include_once '../../includes/dbh.inc.php';

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = md5(mysqli_real_escape_string($conn, $_POST['pwd']));

    $sql = "SELECT * FROM admin WHERE admin_uid='$uid' AND admin_pwd='$pwd'";
    $admin = mysqli_query($conn, $sql);

    // cek bila berhasil login
    if(mysqli_num_rows($admin) > 0){
        if($row = mysqli_fetch_assoc($admin)){
            $_SESSION['uid'] = $row['admin_uid'];
            $_SESSION['pwd'] = $row['admin_pwd'];
        }
        header("Location: ../dashboard");
        exit();
    }
    else{
        header("Location: ../index.php?login=gagal");
        exit();
    }
}
else{
    header("Location: ../index.php");
    exit();
}
