<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');
if (!$teacher_id) {
  return api_no(lang('Anda tidak memiliki akses ke halaman ini.'));
}
$subject_ids  = $db->getcol('SELECT `id` FROM `school_teacher_subject` WHERE `teacher_id` =' . $teacher_id);
$date_current = date('Y-m-d');
$date         = isset($_GET['date']) ? $_GET['date'] : $date_current;
$day          = isset($_GET['day']) ? addslashes($_GET['day']) : date('N', strtotime($date));
if (strtotime($date) < strtotime($date_current)) {
  return api_no(lang('ga bisa lihat laporan jadwal disini, kamu harus ke teacher_schedule_report'));
}
$query            = 'SELECT `id`,`subject_id`,`day`,`clock_start`,`clock_end` FROM `school_schedule` WHERE `subject_id` IN (' . implode(',', $subject_ids) . ') AND `day` = ' . $day . ' ORDER BY `clock_start` ASC'; 
$schedules        = $db->getAll($query);
$schedule_subject = array();
foreach ($schedules as $key => $schedule) {
  $subject_data = $db->getrow('SELECT `sts`.`id`,
                                      `sc`.`id`   AS `course_id`,
                                      `sc`.`name` AS `course_name`,
                                      `scc`.`id`  AS `class_id`, 
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
  $student_attend = $db->getcol('SELECT `id` FROM `school_attendance` WHERE `schedule_id` = ' . $schedule['id'] . ' AND DATE(`created`) = CURDATE() AND `presence` = 1');
  $schedule_count = $db->getcol('SELECT `id` FROM `school_schedule` WHERE `subject_id` IN (' . implode(',', $subject_ids) . ') AND `day` = ' . $schedule['day'] . ' ORDER BY `clock_start` ASC'); 
  $present        = count($student_attend) == count($student_number);
  $days           = ucfirst(api_days($schedule['day']));
  $time_current   = date('H:i:s');
  $time_start     = $schedule['clock_start'];
  $time_end       = $schedule['clock_end'];
  $status         = 5;
  if (date('N') == $schedule['day']) {
    if ($time_current < $time_start) {
      $status = 5; // notyet
    } elseif ($time_current >= $time_start && $time_current <= $time_end) {
      $status = 4; // ongoing
    } elseif ($time_current > $time_end && empty($student_attend)) {
      $status = 3; // late
    } elseif ($time_current > $time_end && !empty($student_attend) && !$present) {
      $status = 2; // finished
    } elseif ($time_current > $time_end && $present) {
      $status = 1; // completed
    }
  }
  $status_text =[];
  switch ($status) {
    case 1:
      $status_text = 'Jadwal Selesai';
      break;
    case 2:
      $status_text = 'Jadwal Selesai';
      break;
    case 3:
      $status_text = 'Jadwal Terlewat';
      break;
    case 4:
      $status_text = 'Jadwal Berlangsung';
      break;
    case 5:
      $status_text = 'Jadwal Belum Dimulai';
      break;
  }
  // pr($status, __FILE__.':'.__LINE__);die();
  $status_merge = ($status == 1 || $status == 2) ? '1-2' : $status; // Menggabungkan status 1 dan 2

  $status_info = $status_merge .'|'. $status_text;
  $schedule_subject[$days][$status_info][] = array(
    'schedule_id'    => $schedule['id'],
    'course'         => $course_data,
    'class'          => $class_data,
    'clock_start'    => $schedule['clock_start'],
    'clock_end'      => $schedule['clock_end'],
    'student_number' => count($student_number),
    'student_attend' => /*(count($student_attend) >= count($student_number)) ? count($student_number) :*/ count($student_attend) ,
    'status'         => $status
  );
}
if (!$schedules) {
  return api_no("data tidak data"); 
}
// usort($schedule_subject[$days][$status_info], function($a, $b) {
//   $statusOrder = [4, 5, 3, 2, 1];
//   if ($a['status'] == $b['status']) {
//     return strcmp($a['clock_start'], $b['clock_start']);
//   }
//   $aIndex = array_search($a['status'], $statusOrder);
//   $bIndex = array_search($b['status'], $statusOrder);
//   return $aIndex - $bIndex;
// });
foreach ($schedule_subject as $day => $schedule_data) {
  $result = array(
    'day'            => $day,
    'total_schedule' => count($schedule_count),
    'schedule'       => array(),
  );

  foreach ($schedule_data as $status_info => $value) {
    [$status, $status_text] = explode('|',$status_info);
    $result_status = array(
      'status'      => (int)$status,
      'status_text' => $status_text,
      'data'        => $value
    );
    $result['schedule'][] = $result_status;
  }
    // $result['total_schedule'] = count($value);

  usort($result['schedule'], function($a, $b) {
    $status_order = [4, 5, 3, 2, 1];
    if ($a['status'] == $b['status']) {
      return strcmp($a['clock_start'], $b['clock_start']);
    }
    $a_index = array_search($a['status'], $status_order);
    $b_index = array_search($b['status'], $status_order);
    return $a_index - $b_index;
  });
  $late_schedule = [];
  foreach ($schedule_data as $schedule) {
    foreach ($schedule as $key => $value) {
      if ($value['status'] === 3) {
        $late_schedule = $value;
      }
    }
  }
  if ($late_schedule) {
    $schedule_id                 = $late_schedule['schedule_id'];
    $class_id                    = $late_schedule['class']['id'];
    $clock                       = $late_schedule['clock_start'] . '-'. $late_schedule['clock_end'];
    $message                     = 'anda lupa absen, di jam ' . $clock;
    $existing_notif              = $db->getone('SELECT `id` FROM `bbc_user_push_notif` WHERE `user_id` = ' . $user_id . ' AND `message` = \''.$message .'\' AND DATE(created) = CURDATE()');
    if ($late_schedule['status'] == 3) {
      if (!$existing_notif) {
        _func('alert');
        alert_push(
          $user_id . '-' . 5,
          lang('Presensi Hari ini'),
          $message,
          'teacher/attandence',
          [
            'url' => 'http://api.test.school.esoftplay.com/student_class?schedule_id='.$schedule_id.'&class_id='.$class_id.'&date='.date('Y-m-d'),
           'teacher_id' => intval($teacher_id),
           'class_id'   => intval($class_id),
          ]
        );
      }
    }
  }
}
return api_ok($result);