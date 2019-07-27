<div class="form-group row">
  <label for="nourut" class="col-sm-3 col-form-label">No. urut</label>
  <div class="col-sm-2">
    <input type="number" class="form-control" name="nourut" value="<?php
        if(isset($_POST['nourut'])){
          echo $_POST['nourut'];
        }
    ?>">
  </div>
</div>
<div class="form-group row">
  <label for="namapaslon" class="col-sm-3 col-form-label">Nama Paslon</label>
  <div class="col-sm-8">
    <input type="text" class="form-control" name="namapaslon" value="<?php
        if(isset($_POST['nourut'])){
            if($row = mysqli_fetch_assoc($dataPaslon)){
                echo $row['nama_paslon'];
            }
        }
    ?>">
  </div>
</div>
<div class="form-group row">
  <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
  <div class="col-sm-8">
    <textarea class="form-control" name="deskripsi" rows="3"><?php
      if(isset($_POST['nourut'])){
        echo $row['deskripsi'];
      }
      ?></textarea>
  </div>
</div>
<div class="form-group row">
  <label for="foto" class="col-sm-3 col-form-label">Foto Paslon</label>
  <div class="col-sm-8">
    <div class="custom-file">
      <input type="file" class="custom-file-input" name="fotoPaslon">
      <label class="custom-file-label" for="fotoPaslon">Pilih foto...</label>
    </div>
      <input type="hidden" name="nourut_lama" value="<?php
      if(isset($_POST['nourut'])){
        echo $_POST['nourut'];
      }
      ?>">
  </div>
</div>