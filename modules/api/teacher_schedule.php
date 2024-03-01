<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (!$teacher_id) {
  return api_no(lang('Anda tidak memiliki akses ke halaman ini.'));
}

$subject_ids = $db->getcol('SELECT `id` FROM `school_teacher_subject` WHERE `teacher_id` =' . $teacher_id);

$current_date = date('Y-m-d');
$date         = isset($_GET['date']) ? $_GET['date'] : $current_date;
$day          = isset($_GET['day']) ? $_GET['day'] : date('N', strtotime($date));

if (strtotime($date) < strtotime($current_date)) {
  return api_no(lang('ga bisa lihat laporan jadwal disini, kamu harus ke teacher_schedule_report'));
}

$query     = 'SELECT `id`,`subject_id`,`day`,`clock_start`,`clock_end` FROM `school_schedule` WHERE `subject_id` IN (' . implode(',', $subject_ids) . ') AND `day` = ' . $day . ' ORDER BY `clock_start` ASC'; 
$schedules = $db->getAll($query);

$schedule_subject   = array();
foreach ($schedules as $key => $schedule) {

  $subject_data = $db->getrow('SELECT `id` , `course_id` , `class_id` FROM `school_teacher_subject` WHERE `id` = ' . $schedule['subject_id']);
  $course_data  = $db->getrow('SELECT `id` , `name` FROM `school_course` WHERE `id` = ' . $subject_data['course_id']);
  $class_data   = $db->getrow('SELECT `id` , CONCAT_WS(" ", `grade`, `major`, `label`) as `name` FROM `school_class` WHERE `id` =' . $subject_data['class_id']);

  $student_number = $db->getcol('SELECT `number` FROM `school_student_class` WHERE `class_id` =' . $class_data['id']);
  $student_attend = $db->getcol('SELECT `id` FROM `school_attendance` WHERE `schedule_id` = ' . $schedule['id'] . ' AND DATE(`created`) = CURDATE() AND `presence` = 1');

  $days = api_days($schedule['day']);

  $current_time = date('H:i:s');
  $start_time   = $schedule['clock_start'];
  $end_time     = $schedule['clock_end'];

  $status  = 5;
  $present = count($student_attend) == count($student_number);

  if (date('N') == $schedule['day']) {
    if ($current_time < $start_time) {
      $status = 5; // notyet
    } elseif ($current_time >= $start_time && $current_time <= $end_time) {
      $status = 4; // ongoing
    } elseif ($current_time > $end_time && empty($student_attend)) {
      $status = 3; // late
    } elseif ($current_time > $end_time && !empty($student_attend) && !$present) {
      $status = 2; // finished
    } elseif ($current_time > $end_time && $present) {
      $status = 1; // completed
    }
  }

  $schedule_subject[$days][] = array(
    'schedule_id'    => $schedule['id'],
    'course'         => $course_data,
    'class'          => $class_data,
    'clock_start'    => $schedule['clock_start'],
    'clock_end'      => $schedule['clock_end'],
    'student_number' => count($student_number),
    'student_attend' => count($student_attend),
    'status'         => $status
  );

}

if (!$schedules) {
  return api_no("data tidak data"); 
}

usort($schedule_subject[$days], function($a, $b) {
  if ($a['status'] == 4 || $b['status'] == 4) {
    return $a['status'] == 4 ? -1 : 1;
  } elseif ($a['status'] == 5 || $b['status'] == 5) {
    return $a['status'] == 5 ? -1 : 1;
  } else {
    return strcmp($a['clock_start'], $b['clock_start']);
  }
});

session_start();

foreach ($schedule_subject as $day => $schedule_data) {
  $result = array(
    'day'            => $day,
    'total_schedule' => count($schedule_data),
    'schedule'       => $schedule_data,
  );

  $last_schedule = end($schedule_data);
  if ($last_schedule) {
    $clock = $last_schedule['clock_start'] . '-'. $last_schedule['clock_end'];
    if ($last_schedule['status'] == 3) {
      if (!isset($_SESSION['notif_sent'])) {
        _func('alert');
        alert_push(
          $user_id . '-' . 5,
          lang('absen hari ini'),
          'anda lupa absen, di jam ' . $clock,
          'teacher/notif',
        );
        $_SESSION['notif_sent'] = true;
      }
    }
  }
}

return api_ok($result);
