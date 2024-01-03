<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$subject = $db->getAssoc("SELECT * FROM school_teacher_subject WHERE 1");
	return api_ok($subject);
}