<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (!empty($user_id)) 
{
  $db->Execute('UPDATE `bbc_user_push` SET `user_id` = 0 WHERE `user_id` = ' .$user_id);
  return api_ok(['message' => 'Logout success']);
} else 
{
  return api_no(['message' => 'Invalid API key']);
}

user_logout($Bbc->user_id);
