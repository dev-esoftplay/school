<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (!empty($teacher)) {
	$id 					= $teacher;
	$result 			= []; 
	$teacher 			= $db->getRow("SELECT * FROM school_teacher WHERE id = $id");
	$result 			= [
		'id' 				=> $teacher['id'],
		'user_id' 	=> $teacher['user_id'],
		'name' 			=> $teacher['name'],
		'nip' 			=> $teacher['nip'],
		'phone' 		=> $teacher['phone'],
		'position' 	=> $teacher['position'],
		'image' 		=> $teacher['image'],
	];
	return api_ok($result);
}

if (empty($teacher))
{
	return api_no(['message' => 'id tidak valid']);
}
