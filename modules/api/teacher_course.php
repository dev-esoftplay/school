<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');


$teacher_course = $db->getall("SELECT * FROM school_teacher_subject WHERE teacher_id = $teacher");
$course_id = $db->getcol("SELECT course_id FROM school_teacher_subject WHERE teacher_id = $teacher");
// $rse_id = $db->getcol("SELECT course_id FROM school_teacher_subject WHERE teacher_id = $teacher");
$course_name = $db->getcol('SELECT name FROM school_course WHERE id IN ('.implode(',', $course_id).');');

return api_ok($course_name);