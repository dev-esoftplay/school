<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$schedule = $db->getAssoc("SELECT * FROM `school_schedule` WHERE 1");
	return api_ok($schedule);
}