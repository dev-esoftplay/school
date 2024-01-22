<?php
if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$class_id     = addslashes(intval($_GET['class_id'])); 
$schedule_id  = addslashes(intval($_GET['schedule_id'])); 

if (!empty($teacher_id) && !empty($class_id)) {
	// Ambil seluruh data siswa dari tabel school_student_class berdasarkan class_id
	$student_data = $db->getall('SELECT ssc.`student_id`, ssc.`number`, ss.`name` 
																FROM `school_student_class` AS ssc 
																INNER JOIN `school_student` AS ss ON ssc.`student_id` = ss.`id` 
																WHERE ssc.`class_id` = '.$class_id);

	$class_name    = $db->getone('SELECT CONCAT_WS(" ", `grade`, `major`, `label`) FROM `school_class` WHERE `id`=' . $class_id);
	$schedule_time = $db->getrow('SELECT `clock_start`, `clock_end` FROM `school_schedule` WHERE `id`=' . $schedule_id); 
	foreach ($student_data as &$student) {
		$student['status'] = 1;
	}

	$result = array(
		'class_name'     		=> $class_name,
		'student_count'	 		=> count($student_data),
		'student_present'		=> count($student_data),
		'student_sick'   		=> '0',
		'student permission'=> '0',
		'student_absent' 		=> '0',
		'clock_start'    		=> $schedule_time['clock_start'],
		'clock_end'      		=> $schedule_time['clock_end'],
		'student_list'   		=> $student_data,
	);

	return api_ok($result);
} else {
	return api_no('Data kelas tidak ditemukan.');
}
