<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$subject_ids = $db->getcol('SELECT `id` FROM `school_teacher_subject` WHERE `teacher_id` =' . $teacher_id);

$current_day = date('N');

$query = 'SELECT `id`,`subject_id`,`day`,`clock_start`,`clock_end` FROM `school_schedule` WHERE `subject_id` IN (' . implode(',', $subject_ids) . ') AND `day` = ' . $current_day . ' ORDER BY `clock_start` ASC';
$schedules = $db->getAll($query);

$schedule_by_days = array();
foreach ($schedules as $schedule) {

  $subject_data = $db->getrow('SELECT `id` , `course_id` , `class_id` FROM `school_teacher_subject` WHERE `id` = ' . $schedule['subject_id']);

  $course_name  = $db->getone('SELECT `name` FROM `school_course` WHERE `id` = ' . $subject_data['course_id']);
  $class_data   = $db->getrow('SELECT * FROM `school_class` WHERE `id` =' . $subject_data['class_id']);
  $class_name   = $class_data['grade'] . ' ' . $class_data['major'] . ' ' . $class_data['label'];

  $class = [
    'id' => $class_data['id'],
    'class_name' => $class_name
  ];
  $target_date = date('Y-m-d');
  $next_week_date = date('Y-m-d', strtotime($target_date . ' +1 week'));

  $creted = $db->getOne('SELECT created FROM `school_attendance` WHERE `schedule_id` =' . $schedule['id']);

  // $now     = date('Y-m-d H:i:s' , time());
  $today      = date('Y-m-d H:i:s' , strtotime('today'));
  $end_of_day = date('Y-m-d 23:59:59', strtotime('today'));
  // pr($end_of_day, __FILE__.':'.__LINE__);die();

  $student_number = $db->getcol('SELECT `number` FROM `school_student_class` WHERE `class_id` =' . $class_data['id']);
  $student_attend = $db->getcol('SELECT `id` FROM `school_attendance` WHERE `schedule_id` = ' . $schedule['id'] . ' AND `created` BETWEEN \'' . $today . '\' AND \'' . $end_of_day . '\' AND `presence` IN (1, 2, 3)');

  $days = api_days($schedule['day']); // Ini adalah function untuk mengubah angka menjadi nama hari
  $day  = strtolower($days);
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
  return api_no(["data tidak data di database"]); 
}

foreach ($schedule_by_days as $day => $schedules) {
  $result = array(
    'day'      => $day,
    'schedule' => $schedules,
  );
}

return api_ok($result);
?>
