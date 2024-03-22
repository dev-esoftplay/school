<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (!$teacher_id) {
  return api_no(lang('Anda tidak memiliki akses ke halaman ini.'));
}
$subject_ids = $db->getCol('SELECT `id` FROM `school_teacher_subject` WHERE `teacher_id` = ' . $teacher_id);
$class_id    = isset($_GET['class_id']) ? intval($_GET['class_id']) : null;
$course_id   = isset($_GET['course_id']) ? intval($_GET['course_id']) : null;
$month       = isset($_GET['month']) ? intval($_GET['month']) : null;
$week        = isset($_GET['week']) ? intval($_GET['week']) : null;
$day         = isset($_GET['day']) ? intval($_GET['day']) : null;

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
$query_filter = 'SELECT `schedule_id` FROM `school_attendance_report`';
if (!empty($filters)) {
  $query_filter .= ' WHERE ' . implode(' AND', $filters);
}

$schedule_ids    = $db->getcol($query_filter);
// $query           = 'SELECT `id`,`subject_id`,`day`,`clock_start`,`clock_end` FROM `school_schedule` WHERE `id` IN (' . implode(',', $schedule_ids) . ') AND `subject_id` IN (' . implode(',', $subject_ids) . ') ORDER BY `clock_start` ASC';
// $schedules       = $db->getAll($query);
$schedule_count  = array();
$schedule_report = array();

$query_report = 'SELECT `id` ,`schedule_id`,`total_present`,`status`,`date_day`,`date_week`,`date_month`, DATE(`created`) as `date` 
                 FROM `school_attendance_report` 
                 WHERE  '. implode(' AND', $filters) . ' AND `schedule_id` IN (' . implode(',', $schedule_ids) . ')
                 ORDER BY `date_day` ASC';
$report_data  = $db->getAll($query_report);

foreach ($report_data as $key => $value) {
  $query           = 'SELECT `id`,`subject_id`,`day`,`clock_start`,`clock_end` FROM `school_schedule` WHERE `id` ='.$value['schedule_id'].'  AND `subject_id` IN (' . implode(',', $subject_ids) . ') ORDER BY `clock_start` ASC';
  $schedule       = $db->getrow($query);
  if (!empty($schedule)) {
    $query_subject = 'SELECT `sts`.`id`,
                              `sc`.`id` AS `course_id`,
                              `sc`.`name` AS `course_name`,
                              `scc`.`id` AS `class_id`, 
                              CONCAT_WS(" ", `scc`.`grade`, `scc`.`major`, `scc`.`label`) AS `class_name`
                      FROM `school_teacher_subject` AS `sts` 
                      INNER JOIN `school_course` AS `sc` ON `sts`.`course_id` = `sc`.`id`  
                      INNER JOIN `school_class` AS `scc` ON `sts`.`class_id` = `scc`.`id`  
                      WHERE `sts`.`id` = ' . $schedule['subject_id'];
    $subject_data = $db->getrow($query_subject);
    $class_data = array(
      'id'   => $subject_data['class_id'],
      'name' => $subject_data['class_name'],
    );
    $course_data = array(
      'id'   => $subject_data['course_id'],
      'name' => $subject_data['course_name'],
    );
    $student_number = $db->getone('SELECT COUNT(`number`) FROM `school_student_class` WHERE `class_id` = ' . $class_data['id']);
    $student_attend = $db->getone('SELECT COUNT(`id`) FROM `school_attendance` WHERE `schedule_id` = ' . $schedule['id'] . ' AND DATE(`created`) = CURDATE() AND `presence` = 1');
    $schedule_count = $db->getone('SELECT COUNT(`id`) FROM `school_schedule` WHERE `subject_id` IN (' . implode(',', $subject_ids) . ') AND `day` = ' . $schedule['day'] . ' ORDER BY `clock_start` ASC'); 
    $days           = api_days($schedule['day']);
    $date           = $value['date'];
    $date_day       = intval($value['date_day']);
    $months         = $value['date_month'];
    $weeks          = $value['date_week'];

    $item = array(
      'report_id'      => $value['id'],
      'schedule_id'    => $schedule['id'],
      'course'         => $course_data,
      'class'          => $class_data,
      'clock_start'    => $schedule['clock_start'],
      'clock_end'      => $schedule['clock_end'],
      'student_number' => (int)$student_number,
      'student_attend' => intval($value['total_present']),
      'status'         => intval($value['status']),
    );
    $key_report     = $months;
    $key_report    .= '|'.(!empty($month) ? (!empty($week) && !empty($month) ? $weeks : '') : $weeks);
    $key_date_merge = $days . '|' . $date . '|'. $date_day. '|'. $schedule_count;
    
    $schedule_report[$key_report][$key_date_merge][] = $item;
  }
}
if (!$report_data) {
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
$result_day   = array();
foreach ($schedule_report as $key_report => $schedule_days) {
  [$key_months, $key_weeks] = explode('|', $key_report);
  $result = (!empty($week) && empty($month) ? ['week' => $key_weeks] :
            (empty($week) && empty($month) && empty($day) ? ['week' => $key_weeks] :
            (!empty($week) && !empty($month) ? ['week' => $key_weeks] :
            (!empty($month) ? ['month' => $key_months] : ['week' => $key_weeks]))));
  $result['schedule_days'] = [];
  foreach ($schedule_days as $key_date_merge => $schedule_data) {
    [$key_day, $key_date, $key_date_day, $key_schedule_count] = explode('|', $key_date_merge);
    $result_day = array(
      'day'               => $key_day,
      'date'              => $key_date,
      'date_day'          => $key_date_day,
      'schedule_total'    => intval($key_schedule_count),
      'schedule_finished' => count($schedule_data),
    );
    $result_data = array();
    if (!empty($day)) {
      $result_data = $schedule_data;
    }
    $result['schedule_days'][] = $result_day;
  }
  if (!empty($day)) {
    $result = $result_data;
  }
}
return api_ok($result);
