<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if ($parent_id)
{
  $parent_data 	 = $db->getrow('SELECT `id`, `name`, `phone` FROM `school_parent` WHERE `id` = ' . $parent_id);
  $student_id    = $db->getone('SELECT `student_id` FROM `school_student_parent` WHERE `parent_id` = ' . $parent_id);
  $student_data  = $db->getrow('SELECT `id`, `name`, `image` FROM `school_student` WHERE `id` = ' . $student_id);
  
  $parent_data = array(
    "parent_id"     => intval($parent_data['id']),
    "name"          => $parent_data['name'],
    "phone"         => $parent_data['phone'],
    "student_id"    => intval($student_data['id']),
    "student_name"  => $student_data['name'],
    "student_image" => api_image_url($student_data['image'], $student_id, 'school/student') ?? '',
  );

  return api_ok($parent_data);
}

