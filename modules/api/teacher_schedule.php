<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$subject_ids = $db->getcol('SELECT `id` FROM `school_teacher_subject` WHERE `teacher_id` =' . $teacher_id);
$current_date = date('Y-m-d');
$date         = isset($_GET['date']) ? $_GET['date'] : $current_date;
$day_num      = date('N', strtotime($date));
$day          = isset($_GET['day']) ? $_GET['day'] : $day_num;

if (strtotime($date) < strtotime($current_date)) {
  return api_no(lang('ga bisa lihat laporan jadwal disini, kamu harus ke teacher_schedule_report'));
}

$query     = 'SELECT `id`,`subject_id`,`day`,`clock_start`,`clock_end` FROM `school_schedule` WHERE `subject_id` IN (' . implode(',', $subject_ids) . ') AND `day` = ' . $day . ' ORDER BY `clock_start` ASC'; 
$schedules = $db->getAll($query);

$schedule_by_days = array();
foreach ($schedules as $schedule) {

  $subject_data = $db->getrow('SELECT `id` , `course_id` , `class_id` FROM `school_teacher_subject` WHERE `id` = ' . $schedule['subject_id']);
  $course_data  = $db->getrow('SELECT `id` , `name` FROM `school_course` WHERE `id` = ' . $subject_data['course_id']);
  $class_data   = $db->getrow('SELECT `id` , CONCAT_WS(" ", `grade`, `major`, `label`) as `name` FROM `school_class` WHERE `id` =' . $subject_data['class_id']);

  $student_number = $db->getcol('SELECT `number` FROM `school_student_class` WHERE `class_id` =' . $class_data['id']);
  $student_attend = $db->getcol('SELECT `id` FROM `school_attendance` WHERE `schedule_id` = ' . $schedule['id'] . ' AND DATE(`created`) = CURDATE() AND `presence` IN (1, 2, 3)');

  $current_time = date('H:i:s');
  $start_time   = $schedule['clock_start'];
  $end_time     = $schedule['clock_end'];

  if ($current_time < $start_time) {
    $status = 5; // notyet
  } elseif ($current_time >= $start_time && $current_time <= $end_time) {
    $status = 4; // ongoing
  } elseif ($current_time > $end_time && empty($student_attend)) {
    $status = 3; // late
    _func('alert');
    alert_push(
      $user_id.'-'. 5, 
      lang('anda lupa absen'), 
      'anda lupa absen', 
      'ppob/transaction_detail', 
      'ppob/order_detail/'
    ); 
  } elseif ($current_time > $end_time && !empty($student_attend)) {
    $status = 2; // finished
  } elseif ($current_time > $end_time && count($student_attend) == count($student_number)) {
    $status = 1; // completed
  }

  $days = api_days($schedule['day']); // Ini adalah function untuk mengubah angka menjadi nama hari
  $schedule_by_days[$days][] = array(
    'schedule_id'    => $schedule['id'],
    'course'         => $course_data,
    'class'          => $class_data,
    'clock_start'    => $schedule['clock_start'],
    'clock_end'      => $schedule['clock_end'],
    'student_number' => count($student_number),
    'student_attend' => count($student_attend),
    'status'         => (strtotime($date) !== strtotime($current_date)) ? 5 : intval($status)
  );
}

usort($schedule_by_days[$days], function($a, $b) {
  if ($a['status'] == 4 || $b['status'] == 4) {
    return $a['status'] == 4 ? -1 : 1;
  } elseif ($a['status'] == 5 || $b['status'] == 5) {
    return $a['status'] == 5 ? -1 : 1;
  } else {
    return strcmp($a['clock_start'], $b['clock_start']);
  }
});

if (!$schedules) {
  return api_no("data tidak data di database"); 
}

foreach ($schedule_by_days as $day => $schedules) {
  // pr(count($schedules), __FILE__.':'.__LINE__);die();
  $result = array(
    'day'            => $day,
    'total_schedule' => count($schedules),
    'schedule'       => $schedules,
  );
}

return api_ok($result);
?>
