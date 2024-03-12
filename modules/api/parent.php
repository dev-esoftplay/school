<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if ($parent_id) 
{
  $parent_data          = $db->getrow('SELECT `id`, `name`, `nik`, `phone`, `birthday`, `address`, `image` FROM `school_parent` WHERE `id` = ' . $parent_id);
  $parent_data['image'] = api_image_url($parent_data['image'], $parent_id, 'school/parent') ?? '';
  return api_ok($parent_data);
} else 
{
  return api_no('Data tidak ditemukan.');
}