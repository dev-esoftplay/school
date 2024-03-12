<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (empty($parent_id)) 
{
  return api_no(lang('Anda tidak memiliki akses ke halaman ini.'));
}

$sql = [];
if (!empty($_POST['name'])) 
{
  $sql['name'] = addslashes($_POST['name']);
}

if (isset($_POST['image'])) 
{
  $img_path = 'images/modules/school/parent/' . $parent_id . '/';
  $files    = glob($img_path . '*');
  
  api_image_save($_POST['image'], $img_path, $parent_id, 'school_parent', 'image', 'id');
}

if (!empty($_POST['phone'])) 
{
  $sql['phone'] = api_phone_replace(addslashes($_POST['phone']));
}

if (empty($sql) && empty($_POST['image'])) 
{
  return api_no(lang('Data tidak ada yang dirubah'));
}

$db->Update('school_parent', $sql, $parent_id);
$db->Update('bbc_account', [
  'image' => $db->getOne('SELECT `image` FROM `school_parent` WHERE `id`=' . $parent_id)
], $user_id);

api_ok(lang('Data berhasil diubah'));