<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$course = $db->getAssoc("SELECT * FROM `school_course` WHERE 1");
	return api_ok($course);
}