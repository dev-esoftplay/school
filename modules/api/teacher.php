<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$teacher = $db->getassoc("SELECT * FROM school_teacher WHERE 1");
	return api_ok($teacher);
}