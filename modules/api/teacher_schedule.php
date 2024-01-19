<?php
if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$subject_ids = $db->getcol('SELECT `id` FROM `school_teacher_subject` WHERE `teacher_id` =' . $teacher_id);

// Ambil hari saat ini dalam bentuk angka (1 - Senin, 7 - Minggu)
$current_day = date('N');

$query = 'SELECT `id`,`subject_id`,`day`,`clock_start`,`clock_end` FROM `school_schedule` WHERE `subject_id` IN (' . implode(',', $subject_ids) . ') AND `day` = ' . $current_day . ';';
$schedules = $db->getAll($query);

$schedule_by_days = array();
foreach ($schedules as $schedule) {

  $subject_data = $db->getrow('SELECT `id` , `course_id` , `class_id` FROM `school_teacher_subject` WHERE `id` = ' . $schedule['subject_id']);

  $course_name = $db->getone('SELECT name FROM school_course WHERE id = ' . $subject_data['course_id']);
  $class_data  = $db->getrow('SELECT * FROM school_class WHERE id =' . $subject_data['class_id']);
  $class_name  = $class_data['grade'] . ' ' . $class_data['major'] . ' ' . $class_data['label'];

  $class = [
    'id' => $class_data['id'],
    'class_name' => $class_name
  ];

  $days = api_schedule_day($schedule['day']); // Ini adalah function untuk mengubah angka menjadi nama hari

  $day = strtolower($days);
  $schedule_by_days[$day][] = array(
      'id'          => $schedule['id'],
      'course_name' => $course_name,
      'class'       => $class,
      'clock_start' => $schedule['clock_start'],
      'clock_end'   => $schedule['clock_end'],
  );
}

foreach ($schedule_by_days as $day => $schedules) {
  $result = array(
    'day'      => $day,
    'schedule' => $schedules,
  );
}

return api_ok($result);
?>
