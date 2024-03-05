<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

/*
UNTUK MELIHAT DAFTAR NOTIFIKASI BERDASARKAN USER_ID MAUPUN GLOBAL (Method: POST)
ARGUMENTS: example -> /user/push-notif/DESC
$user_id   = [opsional]
$group_id  = [opsional]
$last_id   = [opsional] ID notifikasi yang paling terakhir diambil (Method: GET)
$id        = [opsional] menentukan ASC atau DESC untuk default nya ASC (Method: GET)
*/
$output = array(
	'ok'      => 0,
	'message' => 'no available notifications',
	'result'  => []
);
if (!empty($_POST['secretkey']))
{
	$secretkey = _class('crypt')->decode($_POST['secretkey'], _SALT_MOBILE);
	list($time, $apikey) = explode('|', $secretkey);
	$user_id 	 = $db->getone('SELECT `user_id` FROM `member_device` WHERE `key` = "'.$apikey.'"');
	$group_id  = $db->getone('SELECT `group_ids` FROM `bbc_user WHERE `id` = '.$user_id); // agar bisa multi group_id untuk list notif
	$group_id  = implode(',', array_filter($group_id));
	$last_id   = @intval($_GET['last_id']);
	if (!empty($secretkey))
	{
		if (!empty($user_id))
		{
			$user_id  .= ',0';
		}
		if (!empty($group_id))
		{
			$group_id .= ',0';
		}
		$sql  = !empty($group_id) ? ' AND `group_id` IN ('.$group_id.')' : '';
		$sort = (!empty($_GET['id']) && strtoupper($_GET['id']) == 'DESC') ? 'DESC' : 'ASC';
		$sp   = ($sort == 'ASC') ? '>' : '<';
		if (!empty($last_id))
		{
			$add_sql = " AND `id` {$sp} {$last_id}";
		}else{
			$add_sql = '';
		}
		$data = $db->getAll("SELECT * FROM `bbc_user_push_notif` WHERE `user_id` IN ({$user_id}){$sql}{$add_sql} ORDER BY `id` {$sort} LIMIT 10");
		$next = '';
		if (!empty($data))
		{
			$dt = end($data);
			$is = $db->getOne("SELECT 1 FROM `bbc_user_push_notif` WHERE `user_id` IN ({$user_id}){$sql} AND `id` {$sp} {$dt['id']} LIMIT 1");
			if (!empty($is))
			{
				$next = _URL.'api/push_notification/'.$sort.'?last_id='.$dt['id'];
			}
		}
		$output = array(
			'ok'      => 1,
			'message' => 'success',
			'result'  => array(
				'list' => $data,
				'next' => $next
			)
		);
	} else{

	}
}
output_json($output);