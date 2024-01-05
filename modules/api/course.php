<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');


if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['id'])) {
	$course = $db->getAssoc("SELECT * FROM `school_course` WHERE 1");
	return api_ok($course);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
	$id = $_GET['id'];
	$course_id = $db->getAssoc("SELECT * FROM `school_course` WHERE id = $id");

	$result = [
		'id' => $id
	];

	return api_ok($result);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_GET['id'])) {
	$course_name = $_POST['name'];

	$course_insert = $db->Insert('school_course', array(
		'name' => $course_name,
	));

	$result = [
		'course_name' => $course_name,
	];

	api_ok($result);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
  // Misalkan API mengirim data dalam format JSON
 	// $input_data = file_get_contents("php://input");
  // parse_str($input_data, $parsed_data);

  // Ambil data dari API
  $id = $_POST['id']; // ID data yang ingin diperbarui
  // $id_post = $_POST['id'];
  $name = $_POST['name']; //
  // echo "wefwef";
  $course_update = $db->Update('school_course', array(
		'name' => $name,
	), $id);

	$result = [
		'id' => $id,
		'name' => $name,
	];

	if ($course_update) {
		// api_ok($course_update);
		api_ok($result);
	} else {
	    echo "Gagal memperbarui data di database";
	}
}


if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  // Mendapatkan ID data yang akan dihapus
  parse_str(file_get_contents("php://input"), $delete_data);
  $id_to_delete = $delete_data['id']; // ID data yang akan dihapus

  // Melakukan proses penghapusan data dari database
  $delete_result = $db->Execute("DELETE FROM school_course WHERE id = $id_to_delete");

  if ($delete_result) {
		api_ok($delete_result);
  } else {
      echo "Gagal menghapus data dari database";
  }
}
