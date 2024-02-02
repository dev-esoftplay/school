<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');
$schedule_id  	= addslashes(intval($_GET['schedule_id'])); 
$class_id     	= addslashes(intval($_GET['class_id'])); 
$tanggal  			= $_GET['date']; 
$schedule_class = $db->getone('SELECT `id` FROM `school_teacher_subject` WHERE `teacher_id`=' . $teacher_id . ' AND `class_id`=' . $class_id);
if ($schedule_class) 
{
	$student_data = $db->getall('SELECT ssc.`student_id`, ssc.`number`, ss.`name` 
																FROM `school_student_class` AS ssc 
																INNER JOIN `school_student` AS ss ON ssc.`student_id` = ss.`id` 
																WHERE ssc.`class_id` = '.$class_id);
	$class_name    = $db->getone('SELECT CONCAT_WS(" ", `grade`, `major`, `label`) FROM `school_class` WHERE `id`=' . $class_id);
	$schedule_time = $db->getrow('SELECT `clock_start`, `clock_end` FROM `school_schedule` WHERE `id`=' . $schedule_id); 
	$permission 	 = $db->getrow('SELECT `total_present`, `total_s`, `total_i`, `total_a` FROM `school_attendance_report` WHERE `schedule_id`=' . $schedule_id.' AND `class_id` = '. $class_id.' AND DATE(created) = \''.$tanggal.'\'');
	foreach ($student_data as &$student) 
	{
    $notes_result		 				= $db->getrow('SELECT `presence`, `notes` FROM `school_attendance` WHERE `schedule_id`= '. $schedule_id.' AND `student_id` = '.$student['student_id']);
    $notes 									= $notes_result ? $notes_result['notes'] : '';
    $status 								= $notes_result ? $notes_result['presence'] : 1;
    $student['student_id']  = intval($student['student_id']); 
    $student['status']      = intval($status);
    $student['notes']       = $notes;
	}
	
	if ($permission)
	{
		$permission = array(
			'total_present' => $permission['total_present'],
			'total_s'       => $permission['total_s'],
			'total_i'       => $permission['total_i'],
			'total_a'       => $permission['total_a'],
		);
	}else
	{
		$permission = array(
			'total_present' => count($student_data),
			'total_s'       => 0,
			'total_i'       => 0,
			'total_a'       => 0,
		);
	}

	$result = array(
		'class_name'     => $class_name,
		'student_count'	 => count($student_data),
		'permission'     => $permission,
		'clock_start'    => $schedule_time['clock_start'],
		'clock_end'      => $schedule_time['clock_end'],
		'student_list'   => $student_data,
	);
	return api_ok($result);
} else 
{
	return api_no('Data kelas tidak ditemukan.');
}
