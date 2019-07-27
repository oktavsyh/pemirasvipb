<?php

function insertPaslon($target_dir, $new_file_name, $table, $conn){

  $target_file_client = $target_dir . basename($_FILES["fotoPaslon"]["name"]);
  $file_name = pathinfo($target_file_client)['filename'];
  $base_name = pathinfo($target_file_client)['basename'];
  $target_file = str_replace($file_name,$new_file_name.$_POST['nourut'], $target_file_client);

  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fotoPaslon"]["tmp_name"]);
    if($check !== false) {
      echo "File ini adalah file foto - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File ini bukan file foto.";
      $uploadOk = 0;
    }
  }
// Check file size
  if ($_FILES["fotoPaslon"]["size"] > 1000*1024) {
    echo "File foto tidak boleh melebihi 1MB <br> (Ukuran file: ".number_format($_FILES["fotoPaslon"]["size"]/1024/1024, 2)." MB)";
    $uploadOk = 0;
  }
// Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "Maaf, hanya file JPG, JPEG & PNG yang dapat diupload.";
    $uploadOk = 0;
  }

  if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["fotoPaslon"]["tmp_name"], $target_file)) {
      $base_name = str_replace($file_name, $new_file_name.$_POST['nourut'], $base_name);
      $sql = "INSERT INTO $table VALUES ('".
          $_POST['nourut']."','".
          $_POST['namapaslon']."','".
          $_POST['deskripsi']."','".
          $base_name."', 0)";

      if(!mysqli_query($conn, $sql)){
        if(mysqli_errno($conn) == 1062){
          echo "Nomor urut ke-".$_POST['nourut']." sudah ada";
        }
        echo mysqli_error($conn);
      }
      else{
        echo "Data paslon berhasil ditambah!";
      }
    }
    else {
      echo "Upload foto error dengan kode ".$_FILES["fotoPaslon"]["error"];
    }
  }

}

function updatePaslon($target_dir, $new_file_name, $table, $conn){

  if(!($_FILES["fotoPaslon"]["name"] == "")){
    $target_file = $target_dir . basename($_FILES["fotoPaslon"]["name"]);
    $file_name = pathinfo($target_file)['filename'];
    $base_name = pathinfo($target_file)['basename'];
    $target_file = str_replace($file_name,$new_file_name.$_POST['nourut'], $target_file);

    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check file size
    if ($_FILES["fotoPaslon"]["size"] > 1000*1024) {
      echo "File foto tidak boleh melebihi 1MB <br> (Ukuran file: ".number_format($_FILES["fotoPaslon"]["size"]/1024/1024, 2)." MB)";
      exit();
    }
// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
      echo "Maaf, hanya file JPG, JPEG & PNG yang dapat diupload.";
      exit();
    }

    $sql = "SELECT file_foto FROM $table WHERE id=".$_POST['nourut_lama'];
    $linkfotolama = mysqli_query($conn, $sql);
    $base_name = str_replace($file_name,$new_file_name.$_POST['nourut'], $base_name);

    $sql = "UPDATE $table SET id=".$_POST['nourut'].", ".
        "nama_paslon='".$_POST['namapaslon']."', ".
        "deskripsi='".$_POST['deskripsi']."', ".
        "file_foto='".$base_name."' WHERE id=".$_POST['nourut_lama'];
  }
  else{
    $sql = "UPDATE $table SET id=".$_POST['nourut'].", ".
        "nama_paslon='".$_POST['namapaslon']."', ".
        "deskripsi='".$_POST['deskripsi']."' WHERE id=".$_POST['nourut_lama'];
  }

  if(!mysqli_query($conn, $sql)){
    if(mysqli_errno($conn) == 1062){
      echo "Nomor urut ke-".$_POST['nourut']." sudah ada";
    }
  }
  else{
    if(!($_FILES["fotoPaslon"]["name"] == "")){
      if($row = mysqli_fetch_assoc($linkfotolama)){
        unlink($target_dir.$row['file_foto']);
      }
      $uploadOk = 1;
      // Check if image file is a actual image or fake image
      if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fotoPaslon"]["tmp_name"]);
        if($check !== false) {
          echo "File ini adalah file foto - " . $check["mime"] . ".";
          $uploadOk = 1;
        } else {
          echo "File ini bukan file foto.";
          $uploadOk = 0;
        }
      }

      if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["fotoPaslon"]["tmp_name"], $target_file)) {
          echo "Data paslon berhasil diperbarui!";
        }
        else {
          echo "Upload foto error dengan kode ".$_FILES["fotoPaslon"]["error"];
        }
      }
    }
    else{
      echo "Data paslon berhasil diperbarui!";
    }
  }
}