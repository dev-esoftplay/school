<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

// $user = $_POST['user'];
// $en_user = _class('crypt')->encode($user);
// $pass = $_POST['pass'];
// $en_pass = _class('crypt')->encode($pass);


// $username = !empty($_POST['username']) ? $_POST['username'] : $en_user;
// $password = !empty($_POST['password']) ? $_POST['password'] : $en_pass;

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

$result      = (array) $data_output['result'];

$teacherdata = $db->getRow('SELECT *         FROM school_teacher         WHERE user_id    = ' .$result['id']);
$parentdata  = $db->getRow('SELECT *         FROM school_parent          WHERE user_id    = ' .$result['id']);
$studentdata = $db->getRow('SELECT *         FROM school_student         WHERE user_id    = ' .$result['id']);
$course_id   = $db->getcol('SELECT course_id FROM school_teacher_subject WHERE teacher_id = ' .$teacherdata['id']);
$course_name = $db->getCol('SELECT name      FROM school_course          WHERE id IN ('.implode(',', $course_id).');');

// $obj = (object) $course_name;
// if (empty($course_id)) {
//   return api_no('data belum ada');
// }
// $token = get_token($username,$password,$db);
// $result['id'] = $user_id;

//membuatkan token
if (!empty($result['id'])) {
  $token  = strtotime('+10 year');
  $token .= '|' . $result['id'];
  $token .= '|' . intval($db->getOne("SELECT `id` FROM `school_teacher` WHERE `user_id`= {$result['id']}")); // teacher_id
  //ditambahkan jika ada penambahan dari mobile ataupun admin.
  $token .= '|' . 'GET:what';
  $en_token = _class('crypt')->encode($token);
}


$userdata  = [
 'token'   => $en_token,
 'id'      => $result['id'],
 'name'    => $result['name'],
 'email'   => $result['email'],
 'teacher' => $teacherdata,
 'course'  => !empty($course_id) ? $course_name : api_no(['message' => 'Data not found for the given ID']),
 'parent'  => $parentdata,
 'student' => $studentdata,
];

return api_ok($userdata);