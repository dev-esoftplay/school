<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (empty($_POST['username'])) {
 return api_no('username tidak boleh kosong');
}

if (empty($_POST['password'])) {
 return api_no('password tidak boleh kosong');
}

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

$result   = (array) $data_output['result'];


$teacherdata = $db->getRow('SELECT id FROM school_student WHERE id= ' .$resul['id']);

$userdata = [
 'id'      => $result['id'],
 'name'    => $result['name'],
 'email'   => $result['email'],
 'teacher' => $teacherdata
];

api_ok($userdata);