<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

// if (!$teacher_id) {
//   return api_no('kamu ga dapet akses ini');
// }

$student_id                 = addslashes(intval($_GET['student_id']));
$class_id                   = addslashes(intval($_GET['class_id']));
$filter_month               = addslashes($_GET['month'] ?? date('m'));
$filter_week                = isset($_GET['week']) ? addslashes($_GET['week']) : null;
$first_date                 = $db->getone('SELECT `created` FROM `school_attendance` WHERE `student_id` = ' . $student_id . ' ORDER BY created ASC LIMIT 1');
$one_year_later             = date('Y-m-d', strtotime('+1 year', strtotime($first_date)));
$attendance_presence_report = $db->getall('SELECT `presence`, COUNT(*) as `count` FROM `school_attendance` WHERE `student_id` = ' . $student_id . ' AND `created` BETWEEN "' . $first_date . '" AND "' . $one_year_later . '" GROUP BY presence');
$homeroom_verification      = $db->getone('SELECT `teacher_id` FROM `school_class` WHERE `id` = ' . $class_id);
$parent_verification        = $db->getone('SELECT `parent_id` FROM `school_student_parent` WHERE `student_id` = ' . $student_id);
$week_condition             = $filter_week !== null ? ' AND WEEK(created, 3) = ' . $filter_week : '';
$query_attendance_presence  = $db->getall('SELECT `presence`, COUNT(*) as count FROM school_attendance WHERE student_id = ' . $student_id . ' AND MONTH(created) = ' . $filter_month . $week_condition . ' GROUP BY presence');
$schedule_by_day            = $db->getall('SELECT DATE(sa.created) as created_date, ss.day, sa.presence, COUNT(*) as count FROM school_attendance AS sa LEFT JOIN school_schedule AS ss ON sa.schedule_id = ss.id WHERE sa.student_id = ' . $student_id . ' AND MONTH(sa.created) = ' . $filter_month . $week_condition . ' GROUP BY created_date, sa.presence');

$processed_data = [];
foreach ($schedule_by_day as $data) 
{
  $date = $data['created_date'];
  if (!isset($processed_data[$date])) 
  {
    $processed_data[$date] = [
      'created_date'          => $date,
      'day'                   => $data['day'],
      'presence hadir'        => 0,
      'presence sakit'        => 0,
      'presence ijin'         => 0,
      'presence tidak hadir'  => 0,
      'count'                 => 0,
    ];
  }
  switch ($data['presence']) 
  {
    case 1:
      $processed_data[$date]['presence hadir'] = $data['count'];
      break;
    case 2:
      $processed_data[$date]['presence sakit'] = $data['count'];
      break;
    case 3:
      $processed_data[$date]['presence ijin'] = $data['count'];
      break;
    case 4:
      $processed_data[$date]['presence tidak hadir'] = $data['count'];
      break;
  }
  $processed_data[$date]['count'] += $data['count'];
}
$processed_data = array_values($processed_data);


$attendance_report_data = array(
  'hadir'       => 0,
  'sakit'       => 0,
  'ijin'        => 0,
  'tidak_hadir' => 0,
);

foreach ($attendance_presence_report as $data) 
{
  switch ($data['presence']) 
  {
    case 1:
      $attendance_report_data['hadir'] = $data['count'];
      break;
    case 2:
      $attendance_report_data['sakit'] = $data['count'];
      break;
    case 3:
      $attendance_report_data['ijin'] = $data['count'];
      break;
    case 4:
      $attendance_report_data['tidak_hadir'] = $data['count'];  
      break;
  }
}

$result = array(
  'attendance_data' => $attendance_report_data,
  'schedule_day'    => $processed_data,
); 

if($teacher_id != $homeroom_verification && $parent_id == null)
{
  return api_no('Anda tidak punya akses ke halaman ini.');
}else
if($parent_id != $parent_verification && $teacher_id == null) 
{
  return api_no('Anda bukan orang tua dari.');
}

return api_ok($result);