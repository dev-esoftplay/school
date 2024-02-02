<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$data         = json_decode($_POST['data'], true);
$class_id     = addslashes($_POST['class_id']);
$course_id    = addslashes($_POST['course_id']);
$schedule_id  = addslashes($_POST['schedule_id']);
if ($data == null) 
{
  return api_no(['message' => 'Invalid JSON data']);
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

foreach ($data as $entry) 
{
  $query          = 'SELECT `id` FROM school_attendance WHERE student_id = \''.$entry['student_id'].'\' AND schedule_id = \''.$schedule_id.'\' AND DATE(created) = CURDATE()';
  $result         = $db->execute($query);
  $existing_data  = $result->fetch_assoc();

  if ($existing_data) 
  {
    $status = array(
      'presence'    => addslashes($entry['status']),
      'notes'       => addslashes($entry['notes']),
    );
    $db->update('school_attendance', $status, 'id = \''.$existing_data['id'].'\'');
  }else if(!$existing_data)
  {
    $attendance_data = array(
      'schedule_id' => $schedule_id,
      'student_id'  => addslashes($entry['student_id']),
      'presence'    => addslashes($entry['status']),
      'notes'       => addslashes($entry['notes']),
    );
    $db->insert('school_attendance', $attendance_data);
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

$query                    = 'SELECT `id` FROM school_attendance_report WHERE class_id = \''.$class_id.'\' AND schedule_id = \''.$schedule_id.'\' AND course_id = \''.$course_id.'\' AND DATE(created) = CURDATE()';
$result                   = $db->execute($query);
$attendance_report_exist  = $result->fetch_assoc();

if ($attendance_report_exist)
{
  $report = array(
    'total_present' => $totals['total_present'],
    'total_s'       => $totals['total_s'],
    'total_i'       => $totals['total_i'],
    'total_a'       => $totals['total_a'],
  );
  $db->update('school_attendance_report', $report, 'schedule_id = \''.$schedule_id.'\' AND class_id = \''.$class_id.'\' AND DATE(created) = CURDATE()');
}else if (!$attendance_report_exist)
{
  $attendance_report = [
    'schedule_id'   => $schedule_id,
    'class_id'      => $class_id,
    'course_id'     => $course_id,
    'total_present' => $totals['total_present'],
    'total_s'       => $totals['total_s'],
    'total_i'       => $totals['total_i'],
    'total_a'       => $totals['total_a'],
    'date_day'      => date('d'),
    'date_week'     => date('W'), 
    'date_month'    => date('m'),
    'date_year'     => date('Y'),
  ];
  $db->insert('school_attendance_report', $attendance_report);
}
return api_ok(['message' => 'Data added or updated successfully']);
