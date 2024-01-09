<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');
$action = isset($_POST['action']);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$parent = $db->getAssoc("SELECT * FROM `school_parent` WHERE 1");
	return api_ok($parent);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($action)) 
{
	$fields = ['name', 'phone', 'nik', 'nokk', 'address'];
	foreach ($fields as $field) 
	{
		$data[$field] = $_POST[$field];
	}
	
	// update
	if (isset($_POST['id']))
	{
		$id 		= $_POST['id'];
		$result = ['id' => $id]; // Initialize result with id

		if (isset($_POST['name'])) 
		{
			$parent = $db->Update('school_parent', array(
				'name' => $data['name'],
			), $id);
			$result['name'] = $data['name']; 
		}
		if (isset($_POST['phone'])) 
		{
			$parent = $db->Update('school_parent', array(
				'phone' => $data['phone'],
			), $id);
			$result['phone'] = $data['phone']; 
		}
		if (isset($_POST['nik'])) 
		{
			$parent = $db->Update('school_parent', array(
				'nik' => $data['nik'],
			), $id);
			$result['nik'] = $data['nik']; 
		}
		if (isset($_POST['address'])) 
		{
			$parent = $db->Update('school_parent', array(
				'address' => $data['address'],
			), $id);
			$result['address'] = $data['address']; 
		}
		if (isset($_POST['nokk'])) 
		{
			$parent = $db->Update('school_parent', array(
				'nokk' => $data['nokk'],
			), $id);
			$result['nokk'] = $data['nokk']; 
		}	
		api_ok($result);
	}
	// delete
	if (isset($_POST['id']) && $action == 'delete')
	{
		$id 			= $_POST['id'];
		$parent_delete 	= $db->Execute('DELETE FROM `school_parent` WHERE `id` = '.$id.'');
		if ($parent_delete) 
		{
			return api_ok(['message' => 'Data deleted successfully']);
		} else 
		{
			return api_no(['message' => 'Failed to delete data']);
		}
	}
}