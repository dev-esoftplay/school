<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (empty($student_id)) {
  return api_no(lang('Anda tidak memiliki akses ke halaman ini.'));
}

$fieldsToUpdate = ['name', 'nis', 'birthday'];
$sql            = [];

foreach ($fieldsToUpdate as $field) {
  if (!empty($_POST[$field])) {
      $sql[$field] = addslashes($_POST[$field]);
  }
}

if (empty($sql)) {
  return api_no(lang('Data tidak ada yang dirubah'));
}

$db->Update('school_student', $sql, $student_id);

api_ok(lang('Data berhasil diubah'));
