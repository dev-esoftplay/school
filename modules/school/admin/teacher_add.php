<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');
// $data = array('params' => '');
if (!empty($_FILES['file'])) {
  $output = _lib('excel')->read($_FILES['file']['tmp_name'])->sheet(1)->fetch();
  unset($output[1]);
  foreach ($output as $key => $value) {
    $q = $db->getOne("SELECT username FROM bbc_user WHERE username = '$value[C]'");
    if (!$q) {
      $db->Insert('bbc_user', array(
        'username'  => $value['C'],
        // 'password'  => encode($data),
      ));
      echo "Data Berhasil di tambahkan";
    }
    // $db->Insert('bbc_user', array(
    //   'username'  => $value['C'],
    //   // 'password'  => encode($data),
    // ));

    $r  = $db->getOne("SELECT username FROM bbc_account WHERE username = '$value[C]'");
    $y  = $db->getOne("SELECT `id` FROM `bbc_user` WHERE username = '$value[C]'");

    if (!$r) {
      $db->Insert('bbc_account', array(
        'user_id'  => $y,
        'username' => $value['C'],
        'name'     => $value['B'],
      ));
      echo "Data berhasil ditambahkan";
    }

    $s  = $db->getOne("SELECT nip FROM school_teacher WHERE nip = '$value[C]'");
    if (!$s){
      $db->Insert('school_teacher', array(
        'user_id'  => $y,
        'name'     => $value['B'],
        'nip'      => $value['C'],
        'phone'    => $value['D'],
        'position' => $value['E'],
      ));
      echo "Data berhasil di tambahkan";
    }
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

<!-- <div class="container">
  <h2>Formulir Bootstrap 3</h2>
  <form>
    <div class="form-group">
      <label for="nama">Nama:</label>
      <input type="text" class="form-control" id="nama" placeholder="Masukkan nama">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Masukkan email">
    </div>
    <div class="form-group">
      <label for="pesan">Pesan:</label>
      <textarea class="form-control" id="pesan" rows="4" placeholder="Masukkan pesan"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Kirim</button>
  </form>
</div>

<div class="container">
  <h2>Formulir Bootstrap 3</h2>
  <form>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="name">Nama</label>
          <input type="text" class="form-control" id="nama" name="name" placeholder="Masukkan nama">
        </div>
        <div class="form-group">
          <label for="nip">NIP</label>
          <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukkan nip">
        </div>
        <div class="form-group">
          <label for="phone">No HP</label>
          <input type="text" class="form-control" id="phone" name="phone" placeholder="Masukkan No Hp">
        </div>
        <div class="form-group">
          <label for="position">Posisi</label>
          <input type="text" class="form-control" id="position" name="position" placeholder="Masukkan Posisi">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="file">File Excel</label>
          <input type="file" class="form-control" id="file" name="file" placeholder="Masukkan File Excel">
        </div>  
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Kirim</button>
  </form>
</div> -->