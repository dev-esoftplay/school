<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$teacher = $db->getassoc("SELECT * FROM school_teacher WHERE 1");
	return api_ok($teacher);
}

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// 	// $teacher_name = $_POST['nama_guru'];

// 	// $db->Insert('school_teacher', array(
// 	// 	'name' => $teacher_name,
// 	// ));

// 	$input_data = file_get_contents("php://input");


// 	$guru_user_id = $db->Insert('bbc_user', array(
// 		// 'password'  => $password,
// 		'username'  => $_POST['nip'],
// 	));

// 	$db->insert('bbc_account', array(
// 		'user_id'   => $guru_user_id,
// 		'username'  => $_POST['nip'],
// 		'name'      => $_POST['nama_guru']
// 	));

// 	$db->insert('school_teacher', array(
// 		'user_id'   => $guru_user_id,
// 		'name'      => $_POST['nama_guru'],
// 		'nip'       => $_POST['nip'],
// 		'phone'     => $_POST['phone'],
// 		'position'  => $_POST['position']
// 	));

// 	$result = [
// 		'user_id'  => $guru_user_id,
// 		'name' 		 => $_POST['nama_guru'],
// 		'nip' 		 => $_POST['nip'],
// 		'phone'		 => $_POST['phone'],
// 		'position' => $_POST['position'],
// 	];

// 	$api_data = array (
// 		'user_id'   => $guru_user_id,
// 		'nama_guru' => $_POST['nama_guru'],
// 		'nip' 			=> $_POST['nip'],
// 		'nip' 			=> $_POST['nip'],
// 		'position' 	=> $_POST['position'],
// 	);

// 	$api = 'http://api.school.lc/teacher';

// 	$ch  = curl_init($api);

// 	curl_setopt($ch, CURLOPT_POST, 1);
// 	curl_setopt($ch, CURLOPT_POSTFIELDS, $api_data);
// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// 	$response = curl_exec($ch);

// 	curl_close($ch);

// 	echo $response;

// 	api_ok($result);
// } else {
// 	$error = [
// 		'message' => 'Gagal nambah data'
// 	];
// 	api_no($error);
// }

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// 	$data 		= file_get_contents("php://input");	
// 	$jsonData = json_decode($data, true);

// 	api_ok($jsonData);
// }

// $url = 'https://api.school.lc/teacher';
// $data = array(
// 	'name' => 'Asep',
// );

// $options = array(
// 	'http' => array(
// 		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
// 		'method'  => 'POST',
// 		'content' => http_build_query($data),
// 	),
// );

// $context  = stream_context_create($options);
// $result = file_get_contents($url, false, $context);

// if ($result === FALSE) {
// 	// Handle error
// 	echo "Gagal melakukan permintaan HTTP POST";
// } else {
// 	// Proses hasil dari server
// 	echo "Data berhasil ditambahkan!";
// }
