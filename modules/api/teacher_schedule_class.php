<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

// if (!$teacher_id) {
//   return api_no(lang('Anda tidak memiliki akses ke halaman ini.'));
// }

if (!$teacher_id) {
  $class_ids   = $_GET['class_id'];
  $subject_ids = $db->getcol('SELECT `id` FROM `school_teacher_subject` WHERE `class_id` =' . $class_ids);
} else {
  $class_ids   = $db->getcol('SELECT `id` FROM `school_class` WHERE `teacher_id` =' . $teacher_id);
  $subject_ids = $db->getcol('SELECT `id` FROM `school_teacher_subject` WHERE `class_id` IN (' . implode(',', $class_ids) . ') ');
}

$current_date = date('Y-m-d');
$date         = isset($_GET['date']) ? $_GET['date'] : $current_date;
// $day          = isset($_GET['day']) ? $_GET['day'] : 1;

if (strtotime($date) < strtotime($current_date)) {
  return api_no(lang('ga bisa lihat laporan jadwal disini, kamu harus ke teacher_schedule_report'));
}

$query     = 'SELECT `id`,`subject_id`,`day`,`clock_start`,`clock_end` FROM `school_schedule` WHERE `subject_id` IN (' . implode(',', $subject_ids) . ')  ORDER BY `school_schedule`.`day` ASC '; 
$schedules = $db->getAll($query);

$schedule_days = array();
foreach ($schedules as $schedule) {
  $subject_data = $db->getrow('SELECT `sts`.`id`,
                                      `sc`.`id` AS `course_id`,
                                      `sc`.`name` AS `course_name`,
                                      `scc`.`id` AS `class_id`, 
                                      CONCAT_WS(" ", `scc`.`grade`, `scc`.`major`, `scc`.`label`) AS `class_name`
                              FROM `school_teacher_subject` AS `sts` 
                              INNER JOIN `school_course` AS `sc` ON `sts`.`course_id` = `sc`.`id`  
                              INNER JOIN `school_class` AS `scc` ON `sts`.`class_id` = `scc`.`id`  
                              WHERE `sts`.`id` = ' . $schedule['subject_id']);
  $class_data = array(
    'id'   => $subject_data['class_id'],
    'name' => $subject_data['class_name'],
  );
  $course_data = array(
    'id'   => $subject_data['course_id'],
    'name' => $subject_data['course_name'],
  );
  $student_number = $db->getcol('SELECT `number` FROM `school_student_class` WHERE `class_id` =' . $class_data['id']);
  $student_attend = $db->getcol('SELECT `id` FROM `school_attendance` WHERE `schedule_id` =' . $schedule['id'] . ' AND DATE(`created`) = CURDATE()') ;

  $days = api_days($schedule['day']); // Ini adalah function untuk mengubah angka menjadi nama hari
  $schedule_days[$days][] = array(
    'schedule_id'    => $schedule['id'],
    'course'         => $course_data,
    'class'          => $class_data,
    'clock_start'    => $schedule['clock_start'],
    'clock_end'      => $schedule['clock_end'],
    'student_number' => count($student_number),
    'student_attend' => count($student_attend),
  );
}

if (!$schedules) {
  return api_no(["data tidak data"]); 
}

$result = array(
  'days' => array_values(api_days()),
  'schedules' => array()
);

foreach ($schedule_days as $day => $schedules) {
  $result['schedules'][] = array(
    'day'            => $day,
    'total_schedule' => count($schedules),
    'schedule'       => $schedules
  );
}

return api_ok($result);