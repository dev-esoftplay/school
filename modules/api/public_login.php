<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (empty($_POST['username'])) {
  return api_no('username tidak boleh kosong');
}
$_POST['username'] = _class('crypt')->encode(_class('crypt')->decode($_POST['username'], _SALT_MOBILE)); // replace encode dari salt mobile ke salt server

if (empty($_POST['password'])) {
  return api_no('password tidak boleh kosong');
}
$_POST['password'] = _class('crypt')->encode(_class('crypt')->decode($_POST['password'], _SALT_MOBILE)); // replace encode dari salt mobile ke salt server


$data_output = array('ok' => 0);
include _ROOT . 'modules/_cpanel/user/mlogin.html.php';
// di bypass. jika login gagal tidak anggep
if (file_exists(_CACHE . 'failed_login/' . $_SERVER['REMOTE_ADDR'] . '.txt')) {
  unlink(_CACHE . 'failed_login/' . $_SERVER['REMOTE_ADDR'] . '.txt');
}

if (empty($data_output['ok'])) {
  return api_no('invalid login');
}

$result          = (array)$data_output['result'];
$installation_id = addslashes($_POST['installation_id'] ?? '');
if (!empty($installation_id)) {
  $device_data = $db->getRow('SELECT `id`, `user_id`, `key` FROM `member_device` WHERE `installation_id`="' . $installation_id . '" LIMIT 1');
  if (!empty($device_data['id'])) {
    $key = $device_data['key'];
    $sql = ['last_login' => date('Y-m-d H:i:s')];
    if ($device_data['user_id'] != $result['id']) {
      $key              = api_key_generate();
      $members_id       = $db->getOne('SELECT `id` FROM `member` WHERE `user_id`=' . $result['id']);
      $sql['user_id']   = $result['id'];
      $sql['member_id'] = $members_id;
      $sql['key']       = $key;
    }
    $db->Update('member_device', $sql, '`id`=' . $device_data['id']);
  } else {
    $key = api_key_generate();
    $db->Insert('member_device', [
      'user_id'         => $result['id'],
      'member_id'       => $db->getOne('SELECT `id` FROM `member` WHERE `user_id`=' . $result['id']),
      'installation_id' => $installation_id,
      'key'             => $key,
      'last_login'      => date('Y-m-d H:i:s')
    ]);
  }
}

$name = [];

$name_teacher = $db->getOne('SELECT `name` FROM `school_teacher` WHERE `user_id`=' . $result['id']);
$name_parent  = $db->getOne('SELECT `name` FROM `school_parent` WHERE `user_id`=' . $result['id']);
$name_student = $db->getOne('SELECT `name` FROM `school_student` WHERE `user_id`=' . $result['id']);
$name_user    = $db->getOne('SELECT `username` FROM `bbc_user` WHERE `id`=' . $result['id']);

$role         = $db->getone('SELECT `group_ids` FROM `bbc_user` WHERE `id` = ' . $result['id']);

foreach (repairExplode($role) as $index => $value) {
  switch ($role) {
    case '5':
      $name = $name_teacher;
      break;
    
    case '6':
      $name = $name_parent;
      break;

    case '7':
      $name = $name_student;
      break;

    default:
      $name = $name_user;
      break;
  }
}

$userdata = [
  'apikey'    => $key ?? '',
  'group_ids' => repairExplode($role),
  'name'      => $name,
];

return api_ok($userdata);
