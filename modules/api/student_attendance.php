<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$data         = json_decode($_POST['data'], true);
$class_id     = addslashes($_POST['class_id']);
$course_id    = addslashes($_POST['course_id']);
$schedule_ids = json_decode($_POST['schedule_id'], true); // Assuming schedule_id is a JSON array
$teachers_id  = addslashes($_POST['teacher_id']);
$clock_start  = $_POST['clock_start'];
$clock_end    = $_POST['clock_end'];
$current_time = date('H:i:s');
$course_name  = $db->getone('SELECT `school_course`.`name`
                             FROM `school_teacher_subject` 
                             INNER JOIN `school_schedule`  ON `school_teacher_subject`.`id` = `school_schedule`.`subject_id` 
                             INNER JOIN `school_course`  ON `school_course`.`id` = `school_teacher_subject`.`course_id` 
                             WHERE school_schedule.id = ' . $schedule_id);
   
$class_name   = $db->getrow('SELECT CONCAT_WS(" ", `grade`, `major`, `label`) as `name` FROM `school_class` WHERE `id` = ' . $class_id);
  
if ($data == null || $schedule_ids == null) 
{
  return api_no(['message' => 'Invalid JSON data or schedule IDs']);
}

foreach ($data as $entry) 
{
  $required_fields = ['student_id', 'status', 'notes'];

  foreach ($required_fields as $field) 
  {
    if (!isset($entry[$field])) 
    {
      return api_no(['message' => 'Missing ' . $field . ' in JSON data']);
    }
  }
}

if (!is_array($schedule_ids)) 
{
  $schedule_ids = [$schedule_ids];
}

foreach ($schedule_ids as $schedule_id) 
{
  foreach ($data as $entry) 
  {
    $query          = 'SELECT `id` FROM school_attendance WHERE student_id = \'' . $entry['student_id'] . '\' AND schedule_id = \'' . $schedule_id . '\' AND DATE(created) = CURDATE()';
    $result         = $db->execute($query);
    $existing_data  = $result->fetch_assoc();

    if ($existing_data) 
    {
      $status = array(
        'presence'  => addslashes($entry['status']),
        'notes'     => addslashes($entry['notes']),
      );
      $db->update('school_attendance', $status, 'id = \'' . $existing_data['id'] . '\'');
    } else 
    {
      $attendance_data = array(
        'schedule_id' => $schedule_id,
        'student_id'  => addslashes($entry['student_id']),
        'presence'    => addslashes($entry['status']),
        'notes'       => addslashes($entry['notes']),
      );
      $db->insert('school_attendance', $attendance_data);
    }

    $parentid       = $db->getrow('SELECT `parent_id_dad`, `parent_id_mom`, `parent_id_guard` FROM `school_student` WHERE `id` = ' . $entry['student_id']);
    $parent_ids     = array_values($parentid);
    $user_id_parent = $db->getcol('SELECT `user_id` FROM `school_parent` WHERE `id` IN (' . implode(',', $parent_ids) . ')');

    switch ($entry['status']) 
    {
      case 1:
        $status = 'berangkat';
        break;
      case 2:
        $status = 'sakit';
        break;
      case 3:
        $status = 'ijin';
        break;
      case 4:
        $status = 'tidak hadir';
        break;
    }

    _func('alert');
    foreach ($user_id_parent as $id) 
    {
      if ($id != 0) 
      {
        $existing_notif     = $db->getone('SELECT `id` FROM `bbc_user_push_notif` WHERE `user_id` = ' . $id . ' AND DATE(created) = CURDATE() AND `message` LIKE \'%anak anda %\'');
        $existing_schedule  = $db->getone('SELECT `id` FROM `school_attendance` WHERE `schedule_id` = ' . $schedule_id . ' AND `student_id` = ' . $entry['student_id'] . ' AND DATE(created) = CURDATE()');

        if ((!$existing_notif && $status != 'berangkat') || ($status != 'berangkat' && !$existing_schedule)) 
        {
          alert_push(
            $id . '-' . 6,
            lang('Absensi pelajaran ' . $course_name . 'hari ini'),
            $entry['name']. ' ' .$status,
            'parent/notif',
            []
          );
        }
        if ($existing_notif) 
        {
          $db->update('bbc_user_push_notif', ['message' => 'anak anda ' . $status], 'user_id = ' . $id . ' AND DATE(created) = CURDATE()');
        }
      }
    }
  }

  $totals = [
    'total_present' => 0,
    'total_s'       => 0,
    'total_i'       => 0,
    'total_a'       => 0,
  ];

  foreach ($data as $entry) 
  {
    switch ($entry['status']) 
    {
      case 1:
        $totals['total_present']++;
        break;
      case 2:
        $totals['total_s']++;
        break;
      case 3:
        $totals['total_i']++;
        break;
      case 4:
        $totals['total_a']++;
        break;
    }
  }

  
  $query                    = 'SELECT `id` FROM school_attendance_report WHERE class_id = \'' . $class_id . '\' AND schedule_id = \'' . $schedule_id . '\' AND course_id = \'' . $course_id . '\' AND DATE(created) = CURDATE()';
  $result                   = $db->execute($query);
  $attendance_report_exist  = $result->fetch_assoc();
  $exsist_data              = $attendance_report_exist ? 'Update ' : '';
  
  if ($attendance_report_exist) 
  {
    $report = array(
      'total_present' => $totals['total_present'],
      'total_s'       => $totals['total_s'],
      'total_i'       => $totals['total_i'],
      'total_a'       => $totals['total_a'],
    );
    $db->update('school_attendance_report', $report, 'schedule_id = \'' . $schedule_id . '\' AND class_id = \'' . $class_id . '\' AND DATE(created) = CURDATE()');
    $insert_date = $db->getone('SELECT `create_at` FROM school_attendance_report WHERE schedule_id = \'' . $schedule_id . '\' AND class_id = \'' . $class_id . '\' LIMIT 1');
  
  } else if (!$attendance_report_exist) 
  {
    $insert_date = date('Y-m-d'); 
    if ($current_time > $end_time) 
    {
      $status = 3; // late
    } elseif ($current_time > $end_time) 
    {
      $status = 2; // finished
    } elseif ($current_time > $end_time) 
    {
      $status = 1; // completed
    }

    $attendance_report = [
      'teacher_id'    => $teachers_id,
      'schedule_id'   => $schedule_id,
      'class_id'      => $class_id,
      'course_id'     => $course_id,
      'status'        => $status, // 'completed'
      'total_present' => $totals['total_present'],
      'total_s'       => $totals['total_s'],
      'total_i'       => $totals['total_i'],
      'total_a'       => $totals['total_a'],
      'date_day'      => date('d'),
      'date_week'     => api_week_month(strtotime('today')),
      'date_month'    => date('m'),
      'date_year'     => substr(date('Y'), -2),
    ];
    $db->insert('school_attendance_report', $attendance_report);
  }

  _func('alert');
  alert_push(
    $user_id . '-' . 5,
    lang($exsist_data . 'Presensi '. $class_name['name'] .' ' . $course_name),
    'Berangkat ' .$totals['total_present'] . ', Sakit ' . $totals['total_s'] . ', Ijin ' . $totals['total_i'] . ', Alfa ' . $totals['total_a'],
    'teacher/attendeport_student',
    ['url' => 'http://api.test.school.esoftplay.com/student_class?schedule_id='. $schedule_id .'&class_id='. $class_id .'&date='. $insert_date ]
  );

}
return api_ok(['message' => 'Data added or updated successfully']);
