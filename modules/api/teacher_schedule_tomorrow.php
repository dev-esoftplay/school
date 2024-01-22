<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$subject_ids = $db->getcol('SELECT `id` FROM `school_teacher_subject` WHERE `teacher_id` =' . $teacher_id);

error_reporting(E_ALL);
ini_set('display_errors', 1);

$tomorrow   = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d', strtotime('+1 day'));

$day_num   = date('N', strtotime($tomorrow));

$query     = 'SELECT `id`,`subject_id`,`day`,`clock_start`,`clock_end` FROM `school_schedule` WHERE `subject_id` IN (' . implode(',', $subject_ids) . ') AND `day` = ' . $day_num . ';';
$schedules = $db->getAll($query);

$schedule_by_days = array();
foreach ($schedules as $schedule) {

  $subject_data = $db->getrow('SELECT `id` , `course_id` , `class_id` FROM `school_teacher_subject` WHERE `id` = ' . $schedule['subject_id']);
  $course_name  = $db->getone('SELECT `name` FROM `school_course` WHERE `id` = ' . $subject_data['course_id']);
  $class_data   = $db->getrow('SELECT * FROM `school_class` WHERE `id` =' . $subject_data['class_id']);
  $class_name   = $class_data['grade'] . ' ' . $class_data['major'] . ' ' . $class_data['label'];

  $class = [
    'id'         => $class_data['id'],
    'class_name' => $class_name
  ];

  $student_number = $db->getcol('SELECT `number` FROM `school_student_class` WHERE `class_id` =' . $class_data['id']);
  $student_attend = $db->getcol('SELECT `id` FROM `school_attendance` WHERE `schedule_id` =' . $schedule['id']);

  $days = api_days($schedule['day']); // Ini adalah function untuk mengubah angka menjadi nama hari
  $day = strtolower($days);
  $schedule_by_days[$day][] = array(
    'id'             => $schedule['id'],
    'course_name'    => $course_name,
    'class'          => $class,
    'clock_start'    => $schedule['clock_start'],
    'clock_end'      => $schedule['clock_end'],
    'student_number' => count($student_number),
    'student_attend' => count($student_attend),
  );
}

if (!$schedules) {
  return api_no(["jadwal di tanggal ini kosong"]); 
}

foreach ($schedule_by_days as $day => $schedules) {
  $result = array(
    'day'      => $day,
    'schedule' => $schedules,
  );
}

return api_ok($result);
?>
