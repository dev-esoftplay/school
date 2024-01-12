<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$field      = ['name', 'nip', 'phone', 'position',];

if ($teacher_id) {
  $id            = $teacher_id;
  $result        = ['id' => $id]; // Initialize result with id
  foreach ($field as $item) {
    if (isset($_POST[$item])) {
      $teacher_id    = $db->Update(
        'school_teacher',
        [
          $item => $_POST[$item]
        ],
        $id
      );
      $result[$item] = $_POST[$item];
    }
  }
  return api_ok($result);
}

if (empty($teacher_id)) {
  return api_no(['message' => 'id tidak valid']);
}
