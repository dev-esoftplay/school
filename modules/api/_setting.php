<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$user_id   = $merchant_id = $member_id = $mitra_id = 0;
$user_args = [];
$output    = array(
								'ok'          => 0,
								'status_code' => 400,
								'message'     => 'failed to access',
								'result'      => []
							);

if (!empty($Bbc->user_id))
{
	$q   = "SELECT `id` FROM `bbc_user` WHERE id={$Bbc->user_id} AND `active`=1";
	$usr = $db->cacheGetOne($q);
	if (!empty($usr)) $user_id = $usr;

	if (!empty($Bbc->installation_id))
	{
		$exist = $db->cacheGetOne('SELECT `id` FROM `member_device` WHERE `user_id` = '.$user_id.' AND `installation_id` = "'.addslashes($Bbc->installation_id).'"');
		if (empty($exist))
		{
			$output['message']     = lang('Sesi anda habis, silahkan login kembali.');
			$output['status_code'] = 440;

			output_json($output);
		}
	}
}


// if($user_id <= 0)
// {
// 	output_json(['ok' => 0,'message' => lang('User tidak valid')]);
// }

