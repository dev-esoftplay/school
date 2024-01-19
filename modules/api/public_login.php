<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (empty($_POST['username'])) {
 return api_no('username tidak boleh kosong');
}
$_POST['username'] = _class('crypt')->encode(_class('crypt')->decode($_POST['username'], _SALT_MOBILE)); // replace encode dari salt mobile ke salt server

if (empty($_POST['password'])) {
 return api_no('password tidak boleh kosong');
}
$_POST['password'] = _class('crypt')->encode(_class('crypt')->decode($_POST['password'], _SALT_MOBILE)); // replace encode dari salt mobile ke salt server


$data_output = array('ok' => 0);
include _ROOT.'modules/_cpanel/user/mlogin.html.php';
// di bypass. jika login gagal tidak anggep
if (file_exists(_CACHE.'failed_login/'.$_SERVER['REMOTE_ADDR'].'.txt'))
{
  unlink(_CACHE.'failed_login/'.$_SERVER['REMOTE_ADDR'].'.txt');
}

if (empty($data_output['ok']))
{
 return api_no('invalid login');
}

$result          = (array)$data_output['result'];
$installation_id = addslashes($_POST['installation_id'] ?? '');
if (!empty($installation_id)) {
  $device_data = $db->getRow('SELECT `id`, `key` FROM `member_device` WHERE `user_id` = '.$result['id'].' AND `installation_id`="'.$installation_id.'" LIMIT 1');
  if (!empty($device_data['id'])) {
    $key = $device_data['key'];
    $db->Update('member_device', ['last_login' => date('Y-m-d H:i:s')], '`id`='.$device_data['id']);
  }else{
    $key = api_key_generate();
    $db->Insert('member_device', [
      'user_id'         => $result['id'],
      'member_id'       => $db->getOne('SELECT `id` FROM `member` WHERE `user_id`='.$result['id']),
      'installation_id' => $installation_id,
      'key'             => $key,
      'last_login'      => date('Y-m-d H:i:s')
    ]);
  }
}

$role     = $db->getone('SELECT `group_ids` FROM `bbc_user` WHERE `id` = '.$result['id']);
$userdata = [
  'apikey'    => $key ?? '',
  'group_ids' => repairExplode($role),
  'name'      => $result['name'],
];

return api_ok($userdata);