<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

function api_schedule_day_numeric($day_name) 
{
  $day_name = strtolower($day_name);
  $day_number_mapping = array(
    'monday'    => 1,
    'tuesday'   => 2,
    'wednesday' => 3,
    'thursday'  => 4,
    'friday'    => 5,
    'saturday'  => 6,
    'sunday'    => 7
  );

  return isset($day_number_mapping[$day_name]) ? $day_number_mapping[$day_name] : 0;
}