<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');
function api_week_month($date) 
{
  //Get the first day of the month.
  $firstOfMonth = strtotime(date("Y-m-01", $date));
  //Apply above formula.
  return date('W',$date) - date('W',$firstOfMonth) + 1;
}
