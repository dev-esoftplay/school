<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');
$data = array('params' => '');
if (!empty($_FILES['file'])) {
  $output = _lib('excel')->read($_FILES['file']['tmp_name'])->sheet(1)->fetch();
  unset($output[1]);
  foreach ($output as $key => $value) {

    $db->Insert('bbc_user', array(
      'username'  => $value['C'],
      'password'  => encode($data),
    ));

    $y  = $db->getOne("SELECT `id` FROM `bbc_user` WHERE username = '$value[C]'");

    $db->Insert('bbc_account', array(
      'user_id'  => $y,
      'username' => $value['C'],
      'name'     => $value['B'],
    ));

    $db->Insert('school_teacher', array(
      'user_id'  => $y,
      'name'     => $value['B'],
      'nip'      => $value['C'],
      'phone'    => $value['D'],
      'position' => $value['E'],
    ));
    
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