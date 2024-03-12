<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$token = @$_POST['token'];
if (!empty($token))
{
	$is_exist = $db->getOne("SELECT 1 FROM `bbc_user_push` WHERE `token`='{$token}'");
	if ($is_exist)
	{
		api_ok($is_exist);
	}else
  {
		api_no(
			array(
				'message' => lang('Token tidak ditemukan.')
			)
		);
	}
}else
{
	api_no(
		array(
			'message' => lang('Token tidak boleh kosong.')
		)
	);
	return false;
}