<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$fields = array(
  'student_id',
  'class_id',
  'number'
);
foreach ($fields as $field) {
  $input_post[$field] = isset($_POST[$field]) ? htmlspecialchars($_POST[$field]) : '';
}

if (isset($_POST['submit'])) {
  $msg = [];
  if (!empty($_FILES['file']) && ($_POST['submit'] == 'submit_excel')) {
    $output = _lib('excel')->read($_FILES['file']['tmp_name'])->sheet(1)->fetch();
    unset($output[1]);

    foreach ($output as $key => $value) {
      if (isset($value['B'])) {

        $student_id = $db->getOne("SELECT `id` FROM `school_student_class` WHERE `student_id` = '" . $value['B'] . "' ");
        $class_id = $db->getOne("SELECT `id` FROM `school_student_class` WHERE `class_id` = '" . $value['C'] . "' ");
        $attedance_id = $db->getOne("SELECT `id` FROM `school_student_class` WHERE `number` = '" . $value['D'] . "' ");

        $msg_field = [];
        if (!empty($msg_field)) {
          $fields = implode(', ', $msg_field);
          $msg = msg($fields . '. yang kamu masukan belum ada pada data manapun, tambahakan data di task ' . $fields);
        }

        if (!$student_id && !$class_id && !$attedance_id) {
          $student_id = $db->Insert('school_student_class', array(
            'student_id' => $value['B'],
            'class_id' => $value['C'],
            'number' => $value['D'],
          ));

          $msg =  msg('Student Class berhasil ditambahkan', 'success');
        } else {
          $msg =  msg('Student Class gagal ditambahkan', 'danger');
        }
      }
    }
  }
}

if (!empty($_POST['template'])) {
  if ($_POST['template'] == 'download') {
    $r = array(
      array(
        'No' => '',
        'ID Siswa' => '',
        'ID Kelas' => '',
        'Nomor Absen Siswa' => '',
      )
    );
    if (!empty($r)) {
      _func('download');
      download_excel('Template ' . date('Y-m-d') . ' ' . rand(0, 999), $r);
    } else {
      echo msg('Maaf, tidak ada file yg bisa di download', 'danger');
    }
  }
}

include tpl('student_class_add.html.php'); //untuk mengincludekan file html
