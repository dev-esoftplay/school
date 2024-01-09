<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$out = array(
		'1' => 'halo',
		'2' => 'test',
		'3' => 'API' 
	);

	return api_ok($out);
}

