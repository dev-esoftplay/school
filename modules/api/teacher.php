<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$teacher_id = 5;

if ($teacher_id) {
	$id 					= $teacher_id;
	$result 			= ['id' => $id]; // Initialize result with id
	$teacher_id 	= $db->getRow("SELECT * FROM school_teacher WHERE id = $id");
	$result 			= [
		'id' 				=> $teacher_id['id'],
		'user_id' 	=> $teacher_id['user_id'],
		'name' 			=> $teacher_id['name'],
		'nip' 			=> $teacher_id['nip'],
		'phone' 		=> $teacher_id['phone'],
		'position' 	=> $teacher_id['position'],
		'image' 		=> $teacher_id['image'],
	];
	return api_ok($result);
}

if (empty($teacher_id))
{
	return api_no(['message' => 'id tidak valid']);
}
