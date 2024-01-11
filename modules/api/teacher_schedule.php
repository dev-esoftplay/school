<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$subject_id = $db->getcol("SELECT id FROM school_teacher_subject WHERE teacher_id = $teacher");

$query   = 'SELECT * FROM `school_schedule` WHERE `subject_id` IN ('.implode(',', $subject_id).');';
$schedules = $db->getall($query); 

foreach ($schedules as &$schedule) {
  $subject_id_ = $schedule['subject_id'];
  $subject_query = "SELECT * FROM `school_teacher_subject` WHERE `id` = $subject_id_";
  $subject = $db->getrow($subject_query);

  if ($subject) {
    $schedule['subject_id'] = $subject;
  } 

  $teacher_id = $schedule['subject_id']['teacher_id'];
  $teacher_query = "SELECT * FROM `school_teacher` WHERE `id` = $teacher_id";
  $teacher = $db->getrow($teacher_query);

  if ($teacher) {
    $schedule['subject_id']['teacher_id'] = $teacher;
  }

  $course_id = $schedule['subject_id']['course_id'];
  $course_query = "SELECT * FROM `school_course` WHERE `id` = $course_id";
  $course = $db->getrow($course_query);

  if ($course) {
    $schedule['subject_id']['course_id'] = $course;
  }

  $class_id = $schedule['subject_id']['class_id'];
  $class_query = "SELECT * FROM `school_class` WHERE `id` = $class_id";
  $class = $db->getrow($class_query);

  if ($class) {
    $schedule['subject_id']['class_id'] = $class;
  }

}

return api_ok($schedules);