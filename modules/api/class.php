<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if (isset($_GET['id'])) {
		$id      = $_GET['id'];
		$class   = $db->getAssoc("SELECT * FROM `school_class` WHERE `id` = $id");
    if (!$class) {
      return api_no(['message' => 'Data not found for the given ID']);
    }
    foreach ($class as &$data) {
      $data['class_name'] = $data['grade'] . ' ' . $data['label'] . ' ' . $data['major'];
    }
		return api_ok($class);
	}	
	if (!isset($_GET['id'])) {
		$class = $db->getAssoc("SELECT * FROM `school_class`");
    if (!$class) {
      return api_no(['message' => 'Data not found or empty']);
    }
    foreach ($class as &$data) {
      $data['class_name'] = $data['grade'] . ' ' . $data['label'] . ' ' . $data['major'];
    }
		return api_ok($class);
	}	
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  /*DELETE*/
	if (isset($_POST['action'])) {
  	$action = $_POST['action'];
    if ($action === 'delete' && isset($_POST['id'])) {
      $id = $_POST['id'];

      $class_id = $db->getone('SELECT id FROM `school_class` WHERE `id` = '.$id);
      if (!$class_id) {
        return api_no(['message' => 'Id not Found']);
      };
      $class_delete = $db->Execute('DELETE FROM `school_class` WHERE `id` = '.$class_id);

      if ($class_delete) {
        return api_ok(['message' => 'Data deleted successfully']);
      } else {
      	return api_no(['message' => 'Failed to delete data']);
      }
    }
  }

  $result = ['message' => 'Name parameter is missing'];
  if (isset($_POST['teacher_id']) || isset($_POST['class_name'])) {
    $class_name = $_POST['class_name'];
    $teacher_id = $_POST['teacher_id'];

    if ($class_name) {
      $class_parse = explode(" ", $class_name);
      if (count($class_parse) !== 3) {
        return api_no(['message' => 'Invalid class name format']);
      }
      $grade = $class_parse[0];
      $major = $class_parse[1];
      $label = $class_parse[2];
    }

    $required_params = ['teacher_id','class_name'];
    foreach ($required_params as $param) {
      if (!isset($_POST[$param])) {
        return api_no(['message' => "Parameter '$param' is missing"]);
      }
    }

    $class_name_check = $db->getrow("SELECT * FROM `school_class` WHERE `grade` = $grade AND `label` = '$label' AND `major` = '$major' AND `id` != $id");
    $ct               = $db->getrow("SELECT * FROM `school_class` WHERE `teacher_id`='$teacher_id' AND `id` != $id");

	  /*UPDATE*/
    if (isset($_POST['id'])) {
      $id = $_POST['id'];

      $class_id = $db->getone("SELECT `id` FROM `school_class` WHERE `id` = $id");

      if (!$class_id) {
        return api_no(['message' => 'Id not Found']);
      }

      $update_data = [];
      if (isset($teacher_id)) {
        $update_data['teacher_id'] = $teacher_id;
      }
      if (isset($grade) && isset($major) && isset($label)) {
        $update_data['grade'] = $grade;
        $update_data['major'] = $major;
        $update_data['label'] = $label;
      }

      if (empty($update_data)) {
        return api_no(['message' => 'No data to update']);
      }

      if (!$ct && !$class_name_check) {
        $class_update = $db->Update('school_class', $update_data, $id);
      }
      if ($ct) {
        return api_no(['message' => 'Data teacher_id must be unique']);
      }
      if ($class_name_check) {
        return api_no(['message' => 'Combination of grade, label, and major must be unique']);
      }
      if (!$class_update) {
        return api_no(['message' => 'Failed to update data']);
      }
      $result = [
        'message' => 'Data update successful',
        'id' => $id,
        'data_updated_fields' => $update_data
      ];
      return api_ok($result);
    }

    /*INSERT*/
    $missing_fields = [];
    if (!isset($_POST['teacher_id'])) {
      $missing_fields[] = 'teacher_id';
    }
    if (!isset($_POST['class_name'])) {
      $missing_fields[] = 'class_name';
    }
    if (!empty($missing_fields)) {
      $message = 'Required field(s) missing or incomplete: ' . implode(', ', $missing_fields);
      return api_no(['message' => $message]);
    }

    // $ct         = $db->getrow("SELECT *  FROM `school_class` WHERE `teacher_id`='$teacher_id'");
		// $class_name = $db->getrow("SELECT * FROM `school_class` WHERE `grade` = $grade AND `label` = '$label' AND `major` = '$major'");

		if (!$ct && !$class_name_check) {
      $class_insert = $db->Insert('school_class', [
        'teacher_id' => $teacher_id,
        'grade'      => $grade,
        'label'      => $label,
        'major'      => $major
      ]);
		}

  	if ($ct) {
      return api_no(['message' => 'Data teacher_id must be unique']);
    }
    if ($class_name) {
      return api_no(['message' => 'Combination of grade, label, and major must be unique']);
    }
    if (!$class_insert) {
      return api_no(['message' => 'Failed to insert data']);
    }

    $result = $db->getrow('SELECT * FROM `school_class` WHERE `id` = ' . $db->Insert_ID());
    return api_ok([
      'message' => 'Data Insert Succes',
      $result
    ]);

  } else {
    return api_no(['message' => 'Required data fields are missing']);
  }
}