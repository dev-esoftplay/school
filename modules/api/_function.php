<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

include_once __DIR__ . '/functions/image.php';
include_once __DIR__ . '/functions/key.php';
include_once __DIR__ . '/functions/phone.php';
include_once __DIR__ . '/functions/days.php';
include_once __DIR__ . '/functions/days_numeric.php';

/**
 * membuat return bahwa api yang diakses tidak true
 * */
function api_no($value, $status_code = 400)
{
 api_ok($value, 0, $status_code);
}

/**
 * api ok
 * */
function api_ok($value, $is_ok = 1, $status_code=200)
{
 global $output, $db;
 if (empty($value))
 {
  $is_ok = 0;
 }
 if (is_array($value))
 {
  if (isset($value['ok']) && isset($value['message']) && isset($value['result']))
  {
   $output = $value;
  }else{
   $out = array('ok' => $is_ok);

   if (isset($value['ok']))
   {
    $out['ok'] = $value['ok'] ? 1 : 0;
    unset($value['ok']);
   }
   if (isset($value['message']))
   {
    $out['message'] = $value['message'];
    unset($value['message']);
   }
   if ($out['ok'])
   {
    $out['message'] = !empty($out['message']) ? $out['message'] : 'success';
   }
   if (isset($value['result']))
   {
    $out['result'] = $value['result'];
   }else{
    $out['result'] = $value;
   }
   $output = is_array($output) ? array_merge($output, $out) : $out;
  }
 }else{
  $output     = array(
   'ok'       => $is_ok,
   'message'  => $is_ok ? 'success' : (is_string($value) ? $value : (!empty($output['message']) ? $output['message'] : 'failed')),
   'result'   => $value
   );
 }

 $output['status_code'] = $status_code;
 $output['result']      = $output['result'];
}
