<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$class_id     = addslashes(intval($_GET['class_id'])); 
$verification = $db->getone('SELECT `teacher_id` FROM `school_class` WHERE `id` = ' . $class_id);
if (!empty($class_id) && !empty($teacher_id) && ($teacher_id == $verification)) 
{
  $student_data = $db->getall('SELECT ssc.`student_id`, ssc.`number`, ss.`name`, ss.`image` 
                                FROM `school_student_class` AS ssc 
                                INNER JOIN `school_student` AS ss ON ssc.`student_id` = ss.`id` 
                                WHERE ssc.`class_id` = '.$class_id);
  $class_name    = $db->getone('SELECT CONCAT_WS(" ", `grade`, `major`, `label`) FROM `school_class` WHERE `id`=' . $class_id);
  foreach ($student_data as &$student) 
  {
    $student['student_id']  = intval($student['student_id']); 
    $student['image']       = $student['image'] ?? '';
  }
  $result = array(
    'class_name'     => $class_name,
    'student_count'	 => count($student_data),
    'student_list'   => $student_data,
  );
  return api_ok($result);
} else 
{
  return api_no('Anda tidak punya akses ke halaman ini.');
}