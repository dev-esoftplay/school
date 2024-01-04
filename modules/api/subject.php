<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['id'])) {
	$subject = $db->getAssoc("SELECT * FROM school_teacher_subject WHERE 1");
	return api_ok($subject);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
	$id = $_GET['id'];
	$subject_id = $db->getAssoc("SELECT * FROM school_teacher_subject WHERE id = $id");
	return api_ok($subject_id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$teacher_id = $_POST['teacher_id'];
	$course_id  = $_POST['course_id'];
	$class_id   = $_POST['class_id'];

	$subjet_insert = $db->Insert('school_teacher_subject', array(
		'teacher_id' => $teacher_id,
		'course_id'  => $course_id,
		'class_id'   => $class_id,
	));
	return api_ok($subject_insert);
}