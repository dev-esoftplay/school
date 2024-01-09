<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$field      = ['name', 'nip', 'phone', 'position'];
$data       = [];
$data_excel = [];

foreach ($field as $item) {
  $data[$item]        = isset($_POST[$item]) ? $_POST[$item] : null;
  $data_excel[$item]  = isset($_POST[$item]) ? htmlspecialchars($_POST[$item]) : '';

  if (empty($data_excel[$item])) {
    switch ($item) {
      case 'name';
        $data_excel['name']      = 'B';
        break;
      case 'nip';
        $data_excel['nip']       = 'C';
        break;
      case 'phone';
        $data_excel['phone']     = 'D';
        break;
      case 'position';
        $data_excel['position']  = 'E';
        break;
    }
  }
}

$password = encode($data['name']);

if ($_SERVER["REQUEST_METHOD"] == "POST") // HANDLE INSERT DATA FROM INPUT MANUAL DATA
{
  if (isset($_POST['submit']) && $_POST['submit'] == 'submit_form1') {
    $_POST[$item];
  } elseif (isset($_POST['submit']) && $_POST['submit'] == 'submit_form2') {
    unset($_POST[$item]);
  }

  if (!empty($_POST[$item])) {
    $q = $db->getOne("SELECT `username` FROM `bbc_user`       WHERE `username` = '" . $data['nip'] . "'");
    $r = $db->getOne("SELECT `username` FROM `bbc_account`    WHERE `username` = '" . $data['nip'] . "'");
    $s = $db->getOne("SELECT `nip`      FROM `school_teacher` WHERE `nip`      = '" . $data['nip'] . "'");

    if (!$q) {
      $guru_user_id = $db->Insert('bbc_user', array(
        'password'  => $password,
        'username'  => $data['nip'],
      ));
    }

    if (!$r) {
      $db->insert('bbc_account', array(
        'user_id'   => $guru_user_id,
        'username'  => $data['nip'],
        'name'      => $data['name']
      ));
    }

    if (!$s) {
      $db->insert('school_teacher', array(
        'user_id'   => $guru_user_id,
        'name'      => $data['name'],
        'nip'       => $data['nip'],
        'phone'     => $data['phone'],
        'position'  => $data['position']
      ));
    }
    echo '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok-sign" title="ok sign"></span> Sukses Tambah data.</div>';
  }
}

if (!empty($_FILES['file']) && (!empty($_POST) || isset($_POST))) {
  $output = _lib('excel')->read($_FILES['file']['tmp_name'])->sheet(1)->fetch();
  unset($output[1]);
  foreach ($output as $key => $value) {
    $password = encode(!empty($value[$data['name']]));
    $q = $db->getOne("SELECT `username` FROM `bbc_user`       WHERE `username` = '" . $value[$data['nip']] . "'");
    $r = $db->getOne("SELECT `username` FROM `bbc_account`    WHERE `username` = '" . $value[$data['nip']] . "'");
    $s = $db->getOne("SELECT `nip`      FROM `school_teacher` WHERE `nip`      = '" . $value[$data['nip']] . "'");

    if (!$q) {
      $guru_user_id_file = $db->Insert('bbc_user', array(
        'username'       => $value[$data['nip']],
        'password'       => $password,
      ));
    }
    if (!$r) {
      $db->Insert('bbc_account', array(
        'user_id'        => $guru_user_id_file,
        'username'       => $value[$data['nip']],
        'name'           => $value[$data['name']],
      ));
    }
    if (!$s) {
      $db->Insert('school_teacher', array(
        'user_id'        => $guru_user_id_file,
        'name'           => $value[$data['name']],
        'nip'            => $value[$data['nip']],
        'phone'          => $value[$data['phone']],
        'position'       => $value[$data['position']],
      ));
    }
  }
  echo '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok-sign" title="ok sign"></span> Sukses Tambah data.</div>';
}

include tpl('teacher_add.html.php');
