<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$user_id   = $teacher_id = 0;
$user_args = [];
$output    = array(
	'ok'          => 0,
	'status_code' => 400,
	'message'     => 'failed to access',
	'result'      => []
);

if (empty($Bbc->apikey)) {
	$Bbc->mod['task'] = 'no_auth';
	return false;
}

if ($Bbc->apikey != 1) {
	$device_data = $db->getRow('SELECT `user_id`, `member_id` FROM `member_device` WHERE `key`="'.$Bbc->apikey.'"');
	if (empty($device_data)) {
		$Bbc->mod['task'] = 'no_auth';
		return false;
	}

	$user_id = intval($db->getOne('SELECT `id` FROM `bbc_user` WHERE `id`='.$device_data['user_id'].' AND `active`=1'));
	if (empty($user_id)) {
		output_json(['ok' => 0, 'message' => lang('User anda tidak aktif. Silahkan hubungi admin untuk info lebih lanjut.')]);
		return false;
	}

	$teacher_id = intval($db->getOne('SELECT `id` FROM `school_teacher` WHERE `user_id`='.$device_data['user_id']));
	$parent_id  = intval($db->getOne('SELECT `id` FROM `school_parent` WHERE `user_id`='.$device_data['user_id']));
}
