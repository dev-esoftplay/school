<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (!$teacher_id) {
  return api_no(lang('Anda tidak memiliki akses ke halaman ini.'));
}

$course_ids   = $db->getcol('SELECT `course_id` FROM `school_teacher_subject` WHERE `teacher_id` = ' . $teacher_id);
$course_data  = $db->getall('SELECT `id` , `name` FROM `school_course` WHERE `id` IN (' . implode(',', $course_ids) . ')');

return api_ok($course_data);