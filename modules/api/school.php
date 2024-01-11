<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

	$teacher = $db->cacheGetOne("SELECT name FROM school_teacher WHERE id = $teacher");
	return api_ok($teacher);

