<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$subject_ids  = $db->getcol('SELECT `id` FROM `school_teacher_subject` WHERE `teacher_id` = ' . $teacher_id);

$class_id  = isset($_GET['class_id']) ? intval($_GET['class_id']) : null;
$course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : null;
$month     = isset($_GET['month']) ? intval($_GET['month']) : null;
$week      = isset($_GET['week']) ? intval($_GET['week']) : null;
$day       = isset($_GET['day']) ? intval($_GET['day']) : null;

$filters = [];

if (!empty($day)) {
  $filters[] = ' `date_day` = '. $day;
}

if (!empty($month)) {
  $filters[] = ' `date_month` = '. $month;
} else {
  $filters[] = ' `date_month` = ' . date('n');
}

if (!empty($week) && empty($month)) {
  $filters[] = ' `date_week` = '. $week;
} 

if (empty($week) && empty($month) && empty($day)) {
  $week = api_week_month(strtotime('today'));
  $filters[] = ' `date_week` = ' . api_week_month(strtotime('today'));
} 

if (!empty($week) && !empty($month) ) {
  $filters[] = ' `date_week` = '. $week;
}

if (!empty($course_id)) {
  $filters[] = ' `course_id` = ' . $course_id;
}

if (!empty($class_id)) {
  $filters[] = ' `class_id` = ' . $class_id;
}

$query_report = 'SELECT `schedule_id` FROM `school_attendance_report`';

if (!empty($filters)) {
    $query_report .= ' WHERE ' . implode(' AND', $filters);
}

$schedule_ids = $db->getcol($query_report);

$query = 'SELECT `id`,`subject_id`,`day`,`clock_start`,`clock_end` FROM `school_schedule` WHERE `id` IN (' . implode(',', $schedule_ids) . ') AND `subject_id` IN (' . implode(',', $subject_ids) . ') ORDER BY `clock_start` ASC';

$schedule_count    = array();
$schedules_report  = $db->getAll($query);
$schedule_by_weeks = array();
$schedule_by_days  = array();

foreach ($schedules_report as $key => $schedule) {
  $query_report = 'SELECT `id` ,`schedule_id`,`total_present`,`status`,`date_day`,`date_week`,`date_month`, DATE(`created`) as `date` FROM `school_attendance_report` WHERE  '. implode(' AND', $filters) . ' AND `schedule_id` =  '. $schedule['id'];
  $report_data  = $db->getrow($query_report);

  $subject_data = $db->getrow('SELECT `id` , `course_id` , `class_id` FROM `school_teacher_subject` WHERE `id` = ' . $schedule['subject_id']);
  $course_data  = $db->getrow('SELECT `id` , `name` FROM `school_course` WHERE `id` = ' . $subject_data['course_id']);
  $class_data   = $db->getrow('SELECT `id` , CONCAT_WS(" ", `grade`, `major`, `label`) as `name` FROM `school_class` WHERE `id` =' . $subject_data['class_id']);

  $student_number = $db->getcol('SELECT `number` FROM `school_student_class` WHERE `class_id` = ' . $class_data['id']);
  $schedule_count = $db->getcol('SELECT `id` FROM `school_schedule` WHERE `subject_id` IN (' . implode(',', $subject_ids) . ') AND `day` = ' . $schedule['day'] . ' ORDER BY `clock_start` ASC'); 

  $days = api_days($schedule['day']);
  $weeks = $report_data['date_week'];
   $schedule_by_weeks[$weeks][$days][] = array(
    'report_id'      => $report_data['id'],
    'schedule_id'    => $schedule['id'],
		'course'         => $course_data,
    'class'          => $class_data,
    'clock_start'    => $schedule['clock_start'],
    'clock_end'      => $schedule['clock_end'],
    'date'           => $report_data['date'],
    'student_number' => count($student_number),
    'student_attend' => intval($report_data['total_present']),
    'status'         => intval($report_data['status']),
    'date_month'     => intval($report_data['date_month']),
    'date_week'      => intval($report_data['date_week']),
    'date_day'       => intval($report_data['date_day']),
  );
}

if (!$schedules_report) {
  $filter_info = '';
    
  if (!empty($month) && !empty($week) && !empty($day) && !empty($course_id) && !empty($class_id)) {
    $filter_info = 'bulan ' . date('F', $month) . ' minggu ' . $week . ' hari ' . $day .' kelas ' . $class_id.' mapel ' . $course_id;
  } elseif (!empty($day)) {
    $filter_info = 'tanggal ' . $day;
  } elseif (!empty($week)) {
    $filter_info = 'minggu ' . $week;
  } elseif (!empty($month)) {
    $filter_info = 'bulan ' . $month;
  }

  return api_no('Belum ada laporan untuk ' . $filter_info . ' pada filter yang diberikan.');
}

$result       = array();
$result_week  = array();
$result_day   = array();
$result_month = array();

$result_month = array(
  'month' => $month,
  'schedule_by_weeks' => array(),
);

foreach ($schedule_by_weeks as $weeks => $schedule_days) {
  $result_week = array(
    'week' => $weeks,
    'schedule_by_days' => array(),
  );
  foreach ($schedule_days as $days => $schedules) {
    $result_day = array(
      'day'               => $days,
      'schedule_total'    => count($schedule_count),
      'schedule_finished' => count($schedules),
      'schedule'          => $schedules,
    );
    $result_week['schedule_by_days'][]  = $result_day;
  }
  $result_month['schedule_by_weeks'][] = $result_week;
}

if ($day !== null) {
  $result = $result_day;
} 
if ($week !== null) {
  $result = $result_week;
} 
if ($month !== null) {
  $result = $result_month;
}

return api_ok($result);
