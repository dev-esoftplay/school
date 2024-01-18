<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (empty($teacher_id))
{
	return api_no(lang('Anda tidak memiliki akses ke halaman ini.'));
}

$result = $db->getRow('SELECT `name`, `nip`, `phone`, `position`, `image` FROM `school_teacher` WHERE `id` = '.$teacher_id);
if (empty($result))
{
	return api_no(lang('Anda tidak terdaftar sebagai guru. Silahkan hubungi admin untuk info lebih lanjut'));
}

$result['image'] = api_image_url($result['image'], $teacher_id, 'school/teacher');

api_ok($result);
