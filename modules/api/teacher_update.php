<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if ($_SERVER['REQUEST_METHOD' == 'POST'] && !empty($teacher_id)){
  $teacher_update = $db->Update('school_teacher', [
    'name' 		 		=> $_POST['name'],
    'nip'  		 		=> $_POST['nip'],
    'phone'		 		=> $_POST['phone'],
    'position' 		=> $_POST['position'],
  ]);
}