<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$field      = ['nama_guru', 'nip', 'phone', 'position'];
$data       = [];
$data_excel = [];

foreach ($field as $item) {
  $data[$item]        = isset($_POST[$item]) ? $_POST[$item] : null;
  $data_excel[$item]  = isset($_POST[$item]) ? htmlspecialchars($_POST[$item]) : '';

  if (empty($data_excel[$item])) {
    switch ($item) {
      case 'nama_guru';
        $data_excel['nama_guru'] = 'B';
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

$password = encode($data['nama_guru']);

if ($_SERVER["REQUEST_METHOD"] == "POST") // HANDLE INSERT DATA FROM INPUT MANUAL DATA
{
  if (isset($_POST['submit']) && $_POST['submit'] == 'submit_form1') {
    $_POST[$item];
  } elseif (isset($_POST['submit']) && $_POST['submit'] == 'submit_form2') {
    unset($_POST[$item]);
  }

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

include tpl('teacher_add.html.php');
