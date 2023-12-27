<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$field      = ['nama_guru', 'nip', 'phone', 'position'];
$data       = [];
$data_excel = [];

foreach ($field as $item) {
  $data[$item]        = isset($_POST[$item]) ? $_POST[$item] : null;
  $data_excel[$item]  = isset($_POST[$item]) ? htmlspecialchars($_POST[$item]) : '';
}

$password = encode($data['nama_guru']);

if ($_SERVER["REQUEST_METHOD"] == "POST") // HANDLE INSERT DATA FROM INPUT MANUAL DATA
{
  if (!empty($_POST['nama_guru']) && !empty($_POST['nip']) && !empty($_POST['phone']) && !empty($_POST['position'])) {

    $guru_user_id = $db->Insert('bbc_user', array(
      'password'  => $password,
      'username'  => $data['nip'],
    ));

    $db->insert('bbc_account', array(
      'user_id'   => $guru_user_id,
      'username'  => $data['nip'],
      'name'      => $data['nama_guru']
    ));

    $db->insert('school_teacher', array(
      'user_id'   => $guru_user_id,
      'name'      => $data['nama_guru'],
      'nip'       => $data['nip'],
      'phone'     => $data['phone'],
      'position'  => $data['position']
    ));
  }
}
?>

<div class="col-md-8">
  <form method="POST" role="form" enctype="multipart/form-data" class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h1 class="panel-title">Tambah Guru</h1>
      </div>
      <div class="panel-body">
        <div class="form-group">
          <label for="">Field Nama Guru</label>
          <input type="text" name="nama_guru" class="form-control input-file" id="" placeholder="Input field" required>
        </div>
        <div class="form-group">
          <label for="">Field NIP Guru</label>
          <input type="text" name="nip" class="form-control input-file" id="" placeholder="Input field" required>
        </div>
        <div class="form-group">
          <label for="">Field No HP Guru</label>
          <input type="text" name="phone" class="form-control input-file" id="" placeholder="Input field" required>
        </div>
        <div class="form-group">
          <label for="">Field Posisi Guru</label>
          <input type="text" name="position" class="form-control input-file" id="" placeholder="Input field" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
      </div>
    </div>
  </form>
</div>
<?php

if (!empty($_FILES['file']) && (!empty($_POST) || isset($_POST))) {
  $output = _lib('excel')->read($_FILES['file']['tmp_name'])->sheet(1)->fetch();
  unset($output[1]);
  foreach ($output as $key => $value) {
    $password = encode($value[$data['nama_guru']]);
    $q = $db->getOne("SELECT username FROM bbc_user WHERE username = '" . $value[$data['nip']] . "'");
    if (!$q) {
      $db->Insert('bbc_user', array(
        'username'  => $value[$data['nip']],
        'password'  => $password,
      ));
    }

    $r  = $db->getOne("SELECT username FROM bbc_account WHERE username = '" . $value[$data['nip']] . "'");
    $y  = $db->getOne("SELECT `id` FROM `bbc_user` WHERE username = '" . $value[$data['nip']] . "'");

    if (!$r) {
      $db->Insert('bbc_account', array(
        'user_id'  => $y,
        'username' => $value[$data['nip']],
        'name'     => $value[$data['nama_guru']],
      ));
    }

    $s  = $db->getOne("SELECT nip FROM school_teacher WHERE nip = '" . $value[$data['nip']] . "'");
    if (!$s) {
      $db->Insert('school_teacher', array(
        'user_id'  => $y,
        'name'     => $value[$data['nama_guru']],
        'nip'      => $value[$data['nip']],
        'phone'    => $value[$data['phone']],
        'position' => $value[$data['position']],
      ));
    }
  }
}
?>

<div class="col-md-4">
  <form method="POST" role="form" enctype="multipart/form-data">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h1 class="panel-title">Tambah Guru with Excel</h1>
      </div>
      <div class="panel-body">
        <p>Hiraukan Kolom A</p>
        <div class="form-group">
          <label for="">Field Nama Guru</label>
          <input type="text" name="nama_guru" class="form-control" id="" placeholder="Input field" value="<?php echo $data_excel['nama_guru'] ?>">
        </div>
        <div class="form-group">
          <label for="">Field NIP</label>
          <input type="text" name="nip" class="form-control" id="" placeholder="Input field" value="<?php echo $data_excel['nip'] ?>">
        </div>
        <div class="form-group">
          <label for="">Field Phone</label>
          <input type="text" name="phone" class="form-control" id="" placeholder="Input field" value="<?php echo $data_excel['phone'] ?>">
        </div>
        <div class="form-group">
          <label for="">Field Posisition</label>
          <input type="text" name="position" class="form-control" id="" placeholder="Input field" value="<?php echo $data_excel['position'] ?>">
        </div>
        <div class="form-group">
          <label for="fileInput">Pilih File</label>
          <input type="file" name="file" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
      </div>
    </div>
  </form>
</div>