<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$fields = array(
  'student_id',
  'class_id',
  'number'
);
foreach ($fields as $field) 
{
  $input_post[$field] = isset($_POST[$field]) ? htmlspecialchars($_POST[$field]) : '';
}

if (!empty($_FILES['file']) && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['import_excel'])) 
{ 
  $output = _lib('excel')->read($_FILES['file']['tmp_name'])->sheet(1)->fetch();
  unset($output[1]);
  foreach ($output as $key => $value) //LOOPING DATA FROM IMPORT EXCEL
  {
    $data = array(
      'student_id' => $value[$input_post['student_id']],
      'class_id'   => $value[$input_post['class_id']],
      'number'     => $value[$input_post['number']]
    );
    $db->insert('school_student_class', $data);
  }
}
include tpl('student_class_add.html.php'); //untuk mengincludekan file html
