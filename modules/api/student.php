<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		// code...
		$student = $db->getAssoc("SELECT * FROM school_student WHERE id = $id");
		return api_ok($student);
	}	
}
