<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (!empty($_FILES['file'])) {
  $output = _lib('excel')->read($_FILES['file']['tmp_name'])->sheet(1)->fetch();
  unset($output[1]);
  foreach($output as $key => $value){
    $q  = "INSERT INTO bbc_user (username) VALUES ('$value[C]')";
    $db->Execute($q);

    $y  = $db->getOne("SELECT `id` FROM `bbc_user` WHERE username = '$value[C]'");

    $r  = "INSERT INTO bbc_account (`user_id`, `username`, `name`) VALUES ('$y', '$value[C]', '$value[B]')";
    $db->Execute($r);

    $s  = "INSERT INTO school_teacher (`user_id`, `name`, `nip`, `phone`, `position`) VALUES ('$y', '$value[B]', '$value[C]', '$value[D]', '$value[E]')";
    $db->Execute($s);
  }
}
?>
<div class="container">
  <form method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <h1>Tambah Data Guru</h1>
      <label for="fileInput">Pilih File</label>
      <input type="file" name="file">
    </div>
    <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
  </form>
</div>