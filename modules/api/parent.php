<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$parent = $db->getAssoc("SELECT * FROM `school_parent` WHERE 1");
	return api_ok($parent);
}