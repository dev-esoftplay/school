<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if ($parent_id)
{
  $parent_data 	= $db->getrow('SELECT `id`, `name`, `nik`, `phone`, `birthday`, `address` FROM `school_parent` WHERE `id` = ' . $parent_id);

  return api_ok($parent_data);
}
else
{
  return api_no('Data tidak ditemukan.');
}