<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if ($teacher_id) {
  $id            = $teacher_id;
  $result        = ['id' => $id]; // Initialize result with id
  $teacher_id    = $db->Update(
    'school_teacher',
    [
      'name'     => $_POST['name'],
      'nip'      => $_POST['nip'],
      'phone'    => $_POST['phone'],
      'position' => $_POST['position'],
    ],$id);
  $result        = [
    'name'       => $_POST['name'],
    'nip'        => $_POST['nip'],
    'phone'      => $_POST['phone'],
    'position'   => $_POST['position'],
    'image'      => $_POST['image'],
  ];
  return api_ok($result);
}

if (empty($teacher_id)) {
  return api_no(['message' => 'id tidak valid']);
}
