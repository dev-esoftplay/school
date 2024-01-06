<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if (isset($_GET['id'])) {
		$id      = $_GET['id'];
		$class   = $db->getAssoc("SELECT *, CONCAT_WS(' ',grade,label,major) AS class_name FROM school_class WHERE id = $id");
		return api_ok($class);
	}	
	if (!isset($_GET['id'])) {
		$class = $db->getAssoc("SELECT *, CONCAT_WS(' ',grade,label,major) AS class_name FROM school_class");
		return api_ok($class);
	}	
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  /*jika ingin melakukan delete harus ada params action=delete*/
	if (isset($_POST['action'])) {
  	$action = $_POST['action'];
    if ($action === 'delete' && isset($_POST['id'])) {
      $id = $_POST['id'];

      $delete_query = $db->Execute('DELETE FROM school_class WHERE id = '.$id.'');

      if ($delete_query) {
        return api_ok(['message' => 'Data deleted successfully']);
      } else {
      	return api_no(['message' => 'Failed to delete data']);
      }
    }
  }

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

  $result = ['message' => 'Name parameter is missing'];
  if (isset($_POST['teacher_id']) && isset($_POST['class_name'])) {
    $class_name = $_POST['class_name'];
    $teacher_id = $_POST['teacher_id'];

    $class_parse = explode(" ", $class_name);
    if (count($class_parse) !== 3) {
        return api_no(['message' => 'Invalid class name format']);
    }

    $grade = $class_parse[0];
    $major = $class_parse[1];
    $label = $class_parse[2];


	  /*UPDATE*/
    if (isset($_POST['id'])) {
      $id = $_POST['id'];

      $class_id = $db->getone("SELECT id FROM school_class WHERE id = $id");

      if (!$class_id) {
        return api_no(['message' => 'id not found']);
      };

			$ct         = $db->getrow("SELECT *  FROM `school_class` WHERE `teacher_id`='$teacher_id'");
			$class_name = $db->getrow("SELECT *  FROM `school_class` WHERE `grade` = $grade AND `label` = '$label' AND `major` = '$major'");

			if (!$ct && !$class_name) {
	      $class_update = $db->Update('school_class', [
	      	'teacher_id' => $teacher_id,
	        'grade' => $grade,
	        'label' => $label,
	        'major' => $major
	      ], $id);
			}	else {
	    	if ($ct) {
	        return api_no(['message' => 'Data teacher_id must be unique']);
		    }
		    if ($class_name) {
	        return api_no(['message' => 'Combination of grade, label, and major must be unique']);
		    }
			}	

      $result = [
        'message' => 'data update successful',
        'id' => $id,
        'teacher_id' => $teacher_id,
        'grade' => $grade,
        'label' => $label,
        'major' => $major
      ];
      return api_ok($result);
    } 

    /*INSERT*/
    if (!isset($_POST['id'])) {
      $ct         = $db->getrow("SELECT *  FROM `school_class` WHERE `teacher_id`='$teacher_id'");
			$class_name = $db->getrow("SELECT *  FROM `school_class` WHERE `grade` = $grade AND `label` = '$label' AND `major` = '$major'");

			if (!$ct && !$class_name) {
	      $class_insert = $db->Insert('school_class', [
	      	'teacher_id' => $teacher_id,
	        'grade' => $grade,
	        'label' => $label,
	        'major' => $major
	      ]);
			}	else {
	    	if ($ct) {
	        return api_no(['message' => 'Data teacher_id must be unique']);
		    }
		    if ($class_name) {
	        return api_no(['message' => 'Combination of grade, label, and major must be unique']);
		    }
			}	
      $result = [
        'message' => 'Data insert successful',
        'id' => $db->Insert_ID(),
        'teacher_id' => $teacher_id,
        'grade' => $grade,
        'label' => $label,
        'major' => $major
      ];
      return api_ok($result);
    }

  } else {
    return api_no(['message' => 'Required data fields are missing']);
  }
}