<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (empty($teacher_id))
{
  return api_no(lang('Anda tidak memiliki akses ke halaman ini.'));
}

$sql = [];
if (!empty($_POST['name'])) {
  $sql['name'] = addslashes($_POST['name']);
}

if (!empty($_POST['phone'])) {
  $sql['phone'] = addslashes($_POST['phone']);
}

if (!empty($_POST['position'])) {
  $sql['position'] = addslashes($_POST['position']);
}

if (empty($sql)) {
  return api_no(lang('Data tidak ada yang dirubah'));
}

$db->Update('school_teacher', $sql, $teacher_id);

api_ok(lang('Data berhasil diubah'));
