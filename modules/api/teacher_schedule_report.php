<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$class_id   = isset($_GET['class_id']) ? $_GET['class_id'] : null;
$date_month = isset($_GET['month']) ? $_GET['month'] : null;
$date_week  = isset($_GET['week']) ? $_GET['week'] : null;
$date_day   = isset($_GET['day']) ? $_GET['day'] : null;

$subject_ids  = $db->getcol('SELECT `id` FROM `school_teacher_subject` WHERE `teacher_id` = ' . $teacher_id);
$schedule_ids = $db->getcol('SELECT `schedule_id` FROM `school_attendance_report` WHERE DATE(`created`) = CURDATE()');
$current_date = date('Y-m-d');
$current_day  = date('N');
$query        = 'SELECT `id`,`subject_id`,`day`,`clock_start`,`clock_end` FROM `school_schedule` WHERE `id` IN (' . implode(',', $schedule_ids) . ') AND `subject_id` IN (' . implode(',', $subject_ids) . ') AND `day` = ' . $current_day . ' ORDER BY `clock_start` ASC';

if (isset($class_id)) {
  $subject_ids_class = $db->getcol('SELECT `id` FROM `school_teacher_subject` WHERE `teacher_id` =' . $teacher_id . ' AND `class_id` =' . $class_id);
  $class_ids         = $db->getone('SELECT `class_id` FROM `school_teacher_subject` WHERE `id` IN (' . implode(',', $subject_ids) . ') ');
  if (!$class_ids) {
    return api_no('class_id dari guru ini ga ada');
  }
}

if (isset($date_month)) {
  $month = date('n' , strtotime($date_month));
  $schedule_ids = $db->getcol('SELECT `schedule_id` FROM `school_attendance_report` WHERE `date_month` = ' . $month);
  if (!$schedule_ids) {
    return api_no('report bulan in ga ada');
  }
  $query = 'SELECT `id`,`subject_id`,`day`,`clock_start`,`clock_end` FROM `school_schedule` WHERE `id` IN (' . implode(',', $schedule_ids) . ') AND `subject_id` IN (' . implode(',', $subject_ids) . ') ORDER BY `day` ASC';
}

if (!empty($date_week)) {
  $week = date('W' , strtotime($date_week));
  $schedule_ids = $db->getcol('SELECT `schedule_id` FROM `school_attendance_report` WHERE `date_week` = ' . intval($week));
  if (!$schedule_ids) {
    return api_no('report minggu ini ga ada');
  }
  $query = 'SELECT `id`,`subject_id`,`day`,`clock_start`,`clock_end` FROM `school_schedule` WHERE `id` IN (' . implode(',', $schedule_ids) . ') AND `subject_id` IN (' . implode(',', $subject_ids) . ') ORDER BY `day` ASC';
}

if (!empty($date_day)) {
  $day          = date('j' , strtotime($date_day));
  $day_num      = date('N' , strtotime($date_day));
  $schedule_ids = $db->getcol('SELECT `schedule_id` FROM `school_attendance_report` WHERE `date_day` = ' . $day);
  if (!$schedule_ids) {
    return api_no('report hari ini ga ada. ini tanggal ' . $current_date);
  }
  $query = 'SELECT `id`,`subject_id`,`day`,`clock_start`,`clock_end` FROM `school_schedule` WHERE `id` IN (' . implode(',', $schedule_ids) . ') AND `subject_id` IN (' . implode(',', $subject_ids) . ') AND `day` = ' . $day_num . ' ORDER BY `clock_start` ASC';
}

$schedules = $db->getAll($query);

$schedule_by_days = array();
foreach ($schedules as $schedule) {

  $subject_data = $db->getrow('SELECT `id` , `course_id` , `class_id` FROM `school_teacher_subject` WHERE `id` = ' . $schedule['subject_id']);
  $course_data  = $db->getrow('SELECT `id`, `name` FROM `school_course` WHERE `id` = ' . $subject_data['course_id']);
  $class_data   = $db->getrow('SELECT `id` , CONCAT_WS(" ", `grade`, `major`, `label`) as `name` FROM `school_class` WHERE `id` =' . $subject_data['class_id']);

  $student_number = $db->getcol('SELECT `number` FROM `school_student_class` WHERE `class_id` = ' . $class_data['id']);
  $student_attend = $db->getcol('SELECT `id` FROM `school_attendance` WHERE `schedule_id` = ' . $schedule['id'] . ' AND `presence` IN (1, 2, 3) AND DATE(`created`) ' . (!empty($date_day) ? '= \'' . $date_day . '\'' : '= CURDATE()'));
  $report_data    = $db->getrow('SELECT `id`,`total_presence`,`status` FROM `school_attendance_report` WHERE `schedule_id` = ' . $schedule['id'] );

  $days = api_days($schedule['day']);
  $schedule_by_days[$days][] = array(
    'report_id'      => $report_data['id'],
    'schedule_id'    => $schedule['id'],
    'course'         => $course_data,
    'class'          => $class_data,
    'clock_start'    => $schedule['clock_start'],
    'clock_end'      => $schedule['clock_end'],
    'student_number' => count($student_number),
    'student_attend' => count($student_attend),
    'status'         => intval($report_data['status'])
  );
}

if (!$schedules) {
  return api_no("belum ada report"); 
}
$result = array();

foreach ($schedule_by_days as $day => $schedules) {
  if (!empty($date_week) && !empty($date_day)) {
    $result[] = array(
      'day'      => $day,
      'schedule' => $schedules,
    );
  }
  if (!empty($date_week)) {
    $result[] = array(
      'day'      => $day,
      'schedule' => $schedules,
    );
  }
  if (!empty($date_day)) {
    $result = array(
      'day'      => $day,
      'schedule' => $schedules,
    );
  }
  if (empty($date_week) && empty($date_day)) {
    $result = array(
      'day'      => $day,
      'schedule' => $schedules,
    );
  }
}

return api_ok($result);
?>
