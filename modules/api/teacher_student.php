<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

// if (!$teacher_id) {
//   return api_no('kamu ga dapet akses ini');
// }

$class_id              = addslashes(intval($_GET['class_id'])); 
$verification_homeroom = $db->getone('SELECT `teacher_id` FROM `school_class` WHERE `id` = ' . $class_id);

if (!empty($class_id) && !empty($teacher_id) && ($teacher_id == $verification_homeroom)) 
{
  $student_data = $db->getall('SELECT ssc.`student_id`, ssc.`number`, ss.`name`, ss.`image`, ss.`parent_id_dad`, ss.`parent_id_mom`, ss.`parent_id_guard` 
                                FROM `school_student_class` AS ssc 
                                INNER JOIN `school_student` AS ss ON ssc.`student_id` = ss.`id` 
                                WHERE ssc.`class_id` = '.$class_id);
  $class_name   = $db->getone('SELECT CONCAT_WS(" ", `grade`, `major`, `label`) FROM `school_class` WHERE `id`=' . $class_id);
  
  foreach ($student_data as &$student) 
  {
    $student['student_id']  = intval($student['student_id']); 
    $student['image']       = $student['image'] ?? '';
    $query_parent_data      = []; 
    
    if ($student['parent_id_dad'] && $student['parent_id_mom']) 
    { 
      $query_parent_data[] = ['status' => 'dad'] + $db->getrow('SELECT `name`, `phone` FROM `school_parent` WHERE `id` = ' . $student['parent_id_dad']);
      $query_parent_data[] = ['status' => 'mom'] + $db->getrow('SELECT `name`, `phone` FROM `school_parent` WHERE `id` = ' . $student['parent_id_mom']);
    }else 
    if($student['parent_id_guard'])
    {
      $query_parent_data[] = ['status' => 'guard'] + $db->getrow('SELECT `name`, `phone` FROM `school_parent` WHERE `id` = ' . $student['parent_id_guard']);
    }  
    $student['parent']      = $query_parent_data;
  }
  
  $result = array(
    'class_name'     => $class_name,
    'class_id'       => $class_id,
    'student_count'	 => count($student_data),
    'student_list'   => $student_data,
  );

  return api_ok($result);
} else 
{
  return api_no('Anda tidak punya akses ke halaman ini.');
}