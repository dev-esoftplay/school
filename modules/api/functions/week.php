<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

function api_week_month($date) 
{
  $firstOfMonth = strtotime(date("Y-m-01", $date));
  return date('W',$date) - date('W',$firstOfMonth) + 1;
}