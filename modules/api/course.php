<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

/*
	GET 
*/
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$course = $db->getAssoc("SELECT * FROM `school_course` WHERE `id` = $id");
    if (!$course) {
      return api_no(['message' => 'Data not found for the given ID']);
    }
		return api_ok($course);
	}	
	if (!isset($_GET['id'])) {
		$course = $db->getall("SELECT * FROM `school_course` WHERE 1");
    if (!$course) {
      return api_no(['message' => 'Data not found or empty']);
    }
		return api_ok($course);
	}	
}

/*
	INSERT AND UPDATE AND DELETE
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  /*jika ingin melakukan delete harus ada params action=delete*/
	if (isset($_POST['action'])) {
  	$action = $_POST['action'];
    if ($action === 'delete' && isset($_POST['id'])) {
      $id = $_POST['id'];

      $delete_query = $db->Execute('DELETE FROM `school_course` WHERE `id` = '.$id.'');

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
      $course_id = $db->getone("SELECT id FROM `school_course` WHERE `id` = $id");

      if (!$course_id) {
        return api_no(['message' => 'id not found']);
      };

      $course_update = $db->Update('school_course', ['name' => $name], $id);
      $result = [
        'message' => 'data update succes',
        'id' => $id,
        'name' => $name
      ];
      return api_ok($result);
    } 

    if (!isset($_POST['id']))
    {
      $course_insert = $db->Insert('school_course', ['name' => $name]);
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
}