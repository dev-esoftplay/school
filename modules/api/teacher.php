<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$field = ['name', 'nip', 'phone', 'position'];
$data  = [];

foreach ($field as $item) {
	$data[$item] = isset($_POST[$item]) ? $_POST[$item] : '';
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['id'])) {
	$teacher = $db->getall("SELECT * FROM school_teacher WHERE 1");
	return api_ok($teacher);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
	$id 				= $_GET['id'];
	$teacher_id = $db->getall("SELECT * FROM school_teacher WHERE id = $id");
	return api_ok($teacher_id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$id     	= $_POST['id'];
	$action 	= $_POST['action'];
	$password = encode(!empty($data['name']));

	if (!isset($_POST['id'])) {
		$guru_user_id = $db->Insert('bbc_user', array(
			'username'  => $data['nip'],
			'password'  => $password,
		));

		$db->Insert('bbc_account', array(
			'user_id'	  => $guru_user_id,
			'username'  => $value[$data['nip']],
			'name'		  => $value[$data['name']],
		));

		$db->Insert('school_teacher', array(
			'user_id'   => $guru_user_id,
			'name' 		  => $data['name'],
			'nip'  		  => $data['nip'],
			'phone'		  => $data['phone'],
			'position'  => $data['position'],
		));
	}

	if (isset($action) && $action === 'delete' && isset($id)) {
		$teacher_delete = $db->Execute('DELETE FROM school_teacher WHERE id = ' . $id . '');

		if ($teacher_delete) {
			return api_ok([
				'message' 	=> 'Data berhasil dihapus'
			]);
		} else {
			return api_no([
				'message' 	=> 'Gagal hapus data'
			]);
		}
	}

	if (isset($_POST['id'])) {
		$teacher_update = $db->Update('school_teacher', [
			'name' 		 		=> $data['name'],
			'nip'  		 		=> $data['nip'],
			'phone'		 		=> $data['phone'],
			'position' 		=> $data['position'],
		], $id);
	}

	$result = [
		'user_id'	 			=> $guru_user_id,
		'name' 	 	 			=> $data['name'],
		'nip'						=> $data['nip'],
		'phone'  	 			=> $data['phone'],
		'position' 			=> $data['position'],
	];
	return api_ok($result);
}