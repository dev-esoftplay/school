<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$class = $db->getAssoc("SELECT * FROM `school_class` WHERE 1");
	return api_ok($class);
}