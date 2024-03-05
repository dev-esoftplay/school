<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if ($teacher_id)
{
	$teacher_data 	= $db->getrow('SELECT `id`, `name`, `nip`, `phone`, `position`, `birthday`, `image` FROM `school_teacher` WHERE `id` = ' . $teacher_id);
	$class_teacher 	= $db->getrow('SELECT `id`, `grade`, `major`, `label` FROM `school_class` WHERE `teacher_id` = ' . $teacher_id);

	$teacher_data = array(
		"teacher_id"   => intval($teacher_data['id']),
		"name"          => $teacher_data['name'],
		"image"         => api_image_url($teacher_data['image'], $teacher_id, 'school/teacher') ?? '',
		"phone"         => $teacher_data['phone'],
		"nip"           => $teacher_data['nip'],
		"birthday"      => $teacher_data['birthday'],
		"class_id"      => intval($class_teacher['id']),
		"class_name"    => $class_teacher['grade'] . ' ' . $class_teacher['major'] . ' ' . $class_teacher['label'],
	);

	return api_ok($teacher_data);
}
