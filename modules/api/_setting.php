<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$user_id   = $teacher_id = 0;
$user_args = [];
$output    = array(
	'ok'          => 0,
	'status_code' => 400,
	'message'     => 'failed to access',
	'result'      => []
);

if (!empty($Bbc->user_id)) {
	$q   = "SELECT `id` FROM `bbc_user` WHERE id={$Bbc->user_id} AND `active`=1";
	$usr = $db->cacheGetOne($q);
	if (!empty($usr)) $user_id = $usr;
}

if (!empty($Bbc->teacher_id)) {
	$q   = "SELECT `id` FROM `school_teacher` WHERE id={$Bbc->teacher_id}";
	$teacher = $db->cacheGetOne($q);
	if (!empty($teacher)) $teacher_id = $teacher;
}

// if($user_id <= 0)
// {
// 	output_json(['ok' => 0,'message' => lang('User tidak valid')]);
// }
