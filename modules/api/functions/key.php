<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

function api_key_generate()
{
  global $db;
  $key      = str_replace(['+', '/'], ['-', '_'], base64_encode(random_bytes(24)));
  $is_exist = $db->getOne('SELECT 1 FROM `member_device` WHERE `key`="'.$key.'"');
  if (!empty($is_exist)) {
    call_user_func(__FUNCTION__);
  }
  return $key;
}
