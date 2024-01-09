<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

  /*DETAIL*/
	if (isset($_GET['id'])) {
		$id     = $_GET['id'];
		$course = $db->getAssoc('SELECT * FROM `school_course` WHERE `id` = '.$id);
    if (!$course) {
      return api_no(['message' => 'Data not found for the given ID']);
    }
		return api_ok($course);
	}	

  /*GET ALL*/
	$course = $db->getall('SELECT * FROM `school_course` WHERE 1');
  if (!$course) {
    return api_no(['message' => 'Data not found or empty']);
  }
	return api_ok($course);

}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  /*DELETE*/
	if (isset($_POST['action'])) {
  	$action = $_POST['action'];
    if ($action === 'delete' && isset($_POST['id'])) {
      $id = $_POST['id'];

      $course_id = $db->getone('SELECT id FROM `school_course` WHERE `id` = '.$id);
      if (!$course_id) {
        return api_no(['message' => 'Id not Found']);
      };

      $course_delete = $db->Execute('DELETE FROM `school_course` WHERE `id` = '.$course_id);

      if ($course_delete) {
        return api_ok(['message' => 'Data deleted successfully']);
      } else {
      	return api_no(['message' => 'Failed to delete data']);
      }
    }
  }

  if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $course_row = $db->getrow("SELECT * FROM `school_course` WHERE `name` = '$name'");

    $required_params = ['name'];

    foreach ($required_params as $param) {
      if (!isset($_POST[$param])) {
        return api_no(['message' => "Parameter '$param' is missing"]);
      }
    }

    /*UPDATE*/
    if (isset($_POST['id'])) {
      $id = $_POST['id'];

      $course_id = $db->getone('SELECT id FROM `school_course` WHERE `id` = '.$id);

      if (!$course_id) {
        return api_no(['message' => 'Id not Found']);
      };

      $update_data = [];
      if (isset($name)) {
        $update_data['name'] = $name;
      }
      if (empty($update_data)) {
        return api_no(['message' => 'No data to update']);
      }

      if (!$course_row) {
        $course_update = $db->Update('school_course', ['name' => $name], $id);
      } else {
        return api_no(['message' => 'Mungkin data sudah ada di database']);
      }

      if (!$course_update) {
        return api_no(['message' => 'Failed to update data']);
      }    
      $result = [
        'message'             => 'Data Update Succes',
        'id'                  => $id,
        'data_updated_fields' => $update_data
      ];
      return api_ok($result);
    } 


    /*INSERT*/
    $missing_fields = [];
    if (!isset($_POST['name'])) {
      $missing_fields[] = 'name';
    }
    if (!empty($missing_fields)) {
      $message = 'Required field(s) missing or incomplete: ' . implode(', ', $missing_fields);
      return api_no(['message' => $message]);
    }

    // $course_row = $db->getrow('SELECT * FROM `school_course` WHERE `name` = '.$name);

    if (!$course_row) {
      $course_insert = $db->Insert('school_course', ['name' => $name]);
    } else {
      return api_no(['message' => 'Mungkin data sudah ada di database']);
    }

    if (!$course_insert) {
      return api_no(['message' => 'Failed to insert data']);
    }

    $result = $db->getrow('SELECT * FROM `school_course` WHERE `id` = ' . $db->Insert_ID());
    return api_ok([
      'message' => 'Data Insert Succes',
      $result
    ]);

  } else {
    return api_no($result);
  }
}