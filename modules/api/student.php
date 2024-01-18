<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');
// read
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$student = $db->getall('SELECT * FROM `school_student` WHERE 1');
	return api_ok($student);
}

// create update and delete
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
	$fields = ['nis', 'nama_siswa', 'nokk', 'alamat','nama_ayah', 'nomer_telepon_ayah',
						 'nik_ayah', 'nama_ibu', 'nomer_telepon_ibu', 'nik_ibu', 'nama_wali', 
						 'nomer_telepon_wali', 'nik_wali', 'nokk_wali', 'alamat_wali'];

	foreach ($fields as $field) 
	{
		$data[$field] = $_POST[$field];
	}

	$usernamesiswa 	= $data['nis'];
	$usernameayah 	= $data['nik_ayah'];
	$usernameibu 		= $data['nik_ibu'];
	$usernamewali 	= $data['nik_wali'];
	$passwordsiswa 	= encode($data['nama_siswa']);
	$passwordayah 	= encode($data['nama_ayah']);
	$passwordibu 		= encode($data['nama_ibu']);
	$passwordwali 	= encode($data['nama_wali']);
	// Insert 
	if(isset($data['nis']))
	{
		// Insert Data Ayah
		if (isset($data['nik_ayah']) && !empty($data['nik_ayah'])) 
		{
			$ayah_user_id = $db->Insert('`bbc_user`', array(
				'password'  => $passwordayah,
				'username'  => $usernameayah,
				'group_ids' => '4'
			));
			$ayah_parent_id = $db->Insert('school_parent', array(
				'user_id' => $ayah_user_id,
				'name'    => $data['nama_ayah'],
				'phone'   => $data['nomer_telepon_ayah'],
				'nik'     => $data['nik_ayah'],
				'nokk'    => $data['nokk'],
				'address' => $data['alamat'],
			));
			$db->insert('bbc_account', array(
				'user_id' => $ayah_user_id,
				'username'=> $usernameayah,
				'name'    => $data['nama_ayah']
			));
		}

		// Insert Data Ibu
		if (isset($data['nik_ibu']) && !empty($data['nik_ibu'])) 
		{
			$ibu_user_id = $db->Insert('bbc_user', array(
				'password'  => $passwordibu,
				'username'  => $usernameibu,
				'group_ids' => '4'
			));
			$ibu_parent_id = $db->Insert('school_parent', array(
				'user_id' => $ibu_user_id,
				'name'    => $data['nama_ibu'],
				'phone'   => $data['nomer_telepon_ibu'],
				'nik'     => $data['nik_ibu'],
				'nokk'    => $data['nokk'],
				'address' => $data['alamat'],
			));
			$db->insert('bbc_account', array(
				'user_id' => $ibu_user_id,
				'username'=> $usernameibu,
				'name'    => $data['nama_ibu']
			));
		}

		// Insert Data Wali
		if (isset($data['nik_wali']) && !empty($data['nik_wali'])) 
		{
			$wali_user_id = $db->Insert('bbc_user', array(
				'password'  => $passwordwali,
				'username'  => $usernamewali,
				'group_ids' => '4'
			));
			$wali_parent_id = $db->Insert('school_parent', array(
				'user_id' => $wali_user_id,
				'name'    => $data['nama_wali'],
				'phone'   => $data['nomer_telepon_wali'],
				'nik'     => $data['nik_wali'],
				'nokk'    => $data['nokk_wali'],
				'address' => $data['alamat_wali'],
			));
			$db->insert('bbc_account', array(
				'user_id' => $wali_user_id,
				'username'=> $usernamewali,
				'name'    => $data['nama_wali']
			));
		}

		// Insert Student
		if(isset($data['nis']) && !empty($data['nis']))
		{
			$student_user_id = $db->Insert('bbc_user', array(
				'password'  => $passwordsiswa,
				'username'  => $usernamesiswa,
				'group_ids' => '4'
			));
			$student_id = $db->Insert('school_student', array(
				'parent_id_guard' => $wali_parent_id ?? 0,
				'parent_id_dad'   => $ayah_parent_id ?? 0,
				'parent_id_mom'   => $ibu_parent_id ?? 0,
				'user_id'         => $student_user_id,
				'address'         => $data['alamat'],
				'name'            => $data['nama_siswa'],
				'nokk'            => $data['nokk'],
				'nis'             => $data['nis'],
			));
			$db->insert('bbc_account', array(
				'username'=> $usernamesiswa,
				'user_id' => $student_user_id,
				'name'    => $data['nama_siswa']
			));
		}
		else
		{
				echo 'NIS is required';
		}
		
		if (isset($data['nik_ayah']) && !empty($data['nik_ayah'])) 
		{
			$db->Insert('school_student_parent', array(
				'student_id' => $student_id,
				'parent_id'  => $ayah_parent_id
			));
		}
		if (isset($data['nik_ibu']) && !empty($data['nik_ibu'])) 
		{
			$db->Insert('school_student_parent', array(
				'student_id' => $student_id,
				'parent_id'  => $ibu_parent_id
			));
		}
		if (isset($data['nik_wali']) && !empty($data['nik_wali'])) 
		{
			$db->Insert('school_student_parent', array(
				'student_id' => $student_id,
				'parent_id'  => $wali_parent_id
			));
		}
		api_ok(['message' => 'Data inserted successfully']);
	}


	// Update
	if (isset($_POST['id']))
	{
		$id 		= $_POST['id'];
		$result = ['id' => $id]; // Initialize result with id
		if (isset($_POST['nama_siswa'])) 
		{
			$student = $db->Update('school_student', array(
					'name' => $data['nama_siswa'],
			), $id);
			$result['name'] = $data['nama_siswa']; 
		}
		if (isset($_POST['nis'])) 
		{
			$student = $db->Update('school_student', array(
					'nis' => $data['nis'],
			), $id);
			$result['nis'] = $data['nis']; 
		}
		if (isset($_POST['alamat'])) 
		{
			$student = $db->Update('school_student', array(
					'address' => $data['alamat'],
			), $id);
			$result['alamat'] = $data['alamat']; 
		}
		if (isset($_POST['nokk'])) 
		{
			$student = $db->Update('school_student', array(
					'nokk' => $data['nokk'],
			), $id);
			$result['nokk'] = $data['nokk']; 
		}	
		api_ok($result);
	}
	
	$action = isset($_POST['action']);
	// Delete
	if (isset($_POST['id']) && $action == 'delete')
	{
		$id 			= $_POST['id'];
		$student 	= $db->Execute('DELETE FROM `school_student` WHERE `id` = '.$id);
		if ($student) 
		{
			return api_ok(['message' => 'Data deleted successfully']);
		} else 
		{
			return api_no(['message' => 'Failed to delete data']);
		}
	}

}



