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

if (!empty($_POST['phone'])) 
{
  $sql['phone'] = api_phone_replace(addslashes($_POST['phone']));
}

if (empty($sql)) 
{
  return api_no(lang('Data tidak ada yang dirubah'));
}

$db->Update('school_parent', $sql, $parent_id);

api_ok(lang('Data berhasil diubah'));