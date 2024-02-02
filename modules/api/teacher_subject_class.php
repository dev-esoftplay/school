<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$class_ids   = $db->getcol('SELECT `class_id` FROM `school_teacher_subject` WHERE `teacher_id` = ' . $teacher_id);
$class_data  = $db->getall('SELECT `id` , CONCAT_WS(" ", `grade`, `major`, `label`) as `name` FROM `school_class` WHERE `id` IN (' . implode(',', $class_ids) . ')');

return api_ok($class_data);