<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');
if (empty($teacher_id)) {
  return api_no(lang('Anda tidak memiliki akses ke halaman ini.'));
}

$sql = [];
if (!empty($_POST['name'])) {
  $sql['name'] = addslashes($_POST['name']);
}

if (!empty($_POST['phone'])) {
  $sql['phone'] = api_phone_replace(addslashes($_POST['phone']));
}

if (!empty($_POST['position'])) {
  $sql['position'] = addslashes($_POST['position']);
}

if (isset($_POST['image'])) {

  $img_path = 'images/modules/school/teacher/' . $teacher_id . '/';
  $files    = glob($img_path . '*');

  foreach ($files as $file) {
    unlink($file);
  }

  api_image_save($_POST['image'], $img_path, $teacher_id, 'school_teacher', 'image', 'id');
}

if (empty($sql) && empty($_POST['image'])) {
  return api_no(lang('Data tidak ada yang dirubah'));
}

$db->Update('school_teacher', $sql, $teacher_id);
$db->Update('bbc_account', [
  'image' => $db->getOne('SELECT `image` FROM `school_teacher` WHERE `id`=' . $teacher_id)
], $user_id);

api_ok(lang('Data berhasil diubah'));
