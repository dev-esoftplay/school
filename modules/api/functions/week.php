<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

function api_week_month($date) {
  $firstOfMonth = strtotime(date("Y-m-01", $date));
  return date('W',$date) - date('W',$firstOfMonth) + 1;
}

// function api_week_year($date) {
//     $weekOfYear = intval(date("W", $date));
//     if (date('n', $date) == "1" && $weekOfYear > 51) {
//         // It's the last week of the previos year.
//         return 0;
//     }
//     else if (date('n', $date) == "12" && $weekOfYear == 1) {
//         // It's the first week of the next year.
//         return 53;
//     }
//     else {
//         // It's a "normal" week.
//         return $weekOfYear;
//     }
// }