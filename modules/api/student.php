<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$student = $db->getAssoc("SELECT * FROM school_student WHERE id = $id");
		return api_ok($student);
	}	
	if (!isset($_GET['id'])) {
		$student = $db->getAssoc("SELECT * FROM school_student WHERE 1");
		return api_ok($student);
	}	
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_GET['id'])) 
{
  $student_name     = $_POST['name'];
  $student_nis      = $_POST['nis'];
  $student_phone     = $_POST['phone'];
  $student_class_id = $_POST['class_id'];

  $student_insert = $db->Insert('school_student', array(
    'name'       => $student_name,
    'nis'        => $student_nis,
    'phone'     => $student_phone,
    'class_id'   => $student_class_id
  ));

  $result = [
    'name'       => $student_name,
    'nis'        => $student_nis,
    'phone'     => $student_phone,
    'class_id'   => $student_class_id
  ];

  api_ok($result);
}