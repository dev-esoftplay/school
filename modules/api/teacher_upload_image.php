<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (empty($teacher_id)) {
	return api_no(lang('Anda tidak memiliki akses ke halaman ini.'));
}

$img  = _class('images');
$date = date('Y/m/d/H/');
$img->setPath(_ROOT . 'images/uploads/temp/' . $date);
$name = $img->upload($_FILES['image']);

if (!empty($name)) {
	$db->Update('school_teacher', ['image' => $name], $teacher_id);
}

api_ok(lang('Image berhasil di upload'));
