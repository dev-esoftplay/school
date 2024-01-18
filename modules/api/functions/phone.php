<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');
function api_phone_replace($phone)
{
  $phone   = strval($phone);
  $pattern = '/^08/';

  if (preg_match($pattern, $phone)) {
    $phone = preg_replace($pattern, '628', $phone, 1);
  }

  return $phone;
}