<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$teacher = $db->getassoc("SELECT * FROM school_teacher WHERE 1");

return api_ok($teacher);