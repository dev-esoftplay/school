<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

function api_days($day_id='none')
{
	$r = array(
		1 => 'senin',
		2 => 'selasa',
		3 => 'rabu',
		4 => 'kamis',
		5 => 'jumat',
		6 => 'sabtu',
		7 => 'ahad',
		);
	if (is_numeric($day_id))
	{
		return !empty($r[$day_id]) ? $r[$day_id] : $r[1];
	}else{
		return $r;
	}
}