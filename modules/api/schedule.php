<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$schedule = $db->getAssoc("SELECT * FROM `school_schedule` WHERE id = $id");
		if (!$schedule) {
      return api_no(['message' => 'Data not found for the given ID']);
    }
		return api_ok($schedule);
	}	
	if (!isset($_GET['id'])) {
		$schedule = $db->getAssoc("SELECT * FROM `school_schedule` WHERE 1");
    if (!$schedule) {
      return api_no(['message' => 'Data not found or empty']);
    }
		return api_ok($schedule);
	}	
}

/*if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	if (isset($_POST['action'])) {
  	$action = $_POST['action'];
    if ($action === 'delete' && isset($_POST['id'])) {
      $id = $_POST['id'];

      $delete_query = $db->Execute('DELETE FROM `school_schedule` WHERE `id` = '.$id.'');

      if ($delete_query) {
        return api_ok(['message' => 'Data deleted successfully']);
      } else {
      	return api_no(['message' => 'Failed to delete data']);
      }
    }
  }

  $result = ['message' => 'Name parameter is missing'];
  if (isset($_POST['name'])) {
    $name = $_POST['name'];

    if (isset($_POST['id'])) {
      $id = $_POST['id'];
      $schedule_id = $db->getone("SELECT id FROM `school_schedule` WHERE `id` = $id");

      if (!$schedule_id) {
        return api_no(['message' => 'id not found']);
      };

      $schedule_update = $db->Update('school_schedule', ['name' => $name], $id);
      $result = [
        'message' => 'data update succes',
        'id' => $id,
        'name' => $name
      ];
      return api_ok($result);
    } 

    if (!isset($_POST['id']))
    {
      $schedule_insert = $db->Insert('school_schedule', ['name' => $name]);
      $result = [
        'message' => 'data insert succes',
        'id'      => $db->Insert_ID(),
        'name'    => $name
      ];
      return api_ok($result);
    }
  } else {
    return api_no($result);
  }
}*/