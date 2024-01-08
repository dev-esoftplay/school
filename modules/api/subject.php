<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$query = "SELECT * FROM `school_teacher_subject` WHERE id = $id";
    $subject = $db->getAssoc($query);	
    if (!$subject) {
      return api_no(['message' => 'Data not found for the given ID']);
    }

    $teacher_id = $subject[$id]['teacher_id'];
    $teacher_query = "SELECT * FROM `school_teacher` WHERE id = $teacher_id";
    $teacher = $db->getrow($teacher_query);

    if (!$teacher) {
        return api_no(['message' => 'Teacher data not found for the given ID']);
    }
		
    $course_id = $subject[$id]['course_id'];
    $course_query = "SELECT * FROM `school_course` WHERE id = $course_id";
    $course = $db->getrow($course_query);

    if (!$teacher) {
        return api_no(['message' => 'Teacher data not found for the given ID']);
    }
		
    $class_id = $subject[$id]['class_id'];
    $class_query = "SELECT * FROM `school_class` WHERE id = $class_id";
    $class = $db->getrow($class_query);

    if (!$teacher) {
        return api_no(['message' => 'Teacher data not found for the given ID']);
    }
		
		$subject[$id]['teacher_id'] = $teacher;
		$subject[$id]['course_id'] = $course;
		$subject[$id]['class_id'] = $class;

		return api_ok($subject);
	}

	$query = "SELECT * FROM `school_teacher_subject` WHERE 1";
  $subjects = $db->getall($query);

  if (!$subjects) {
      return api_no(['message' => 'Data not found or empty']);
  }

  foreach ($subjects as &$subject) {
      $teacher_id = $subject['teacher_id'];
      $teacher_query = "SELECT * FROM `school_teacher` WHERE id = $teacher_id";
      $teacher = $db->getrow($teacher_query);

      if ($teacher) {
          $subject['teacher_id'] = $teacher;
      }	        

      $course_id = $subject['course_id'];
      $course_query = "SELECT * FROM `school_course` WHERE id = $course_id";
      $course = $db->getrow($course_query);

      if ($course) {
          $subject['course_id'] = $course;
      }	       

      $class_id = $subject['class_id'];
      $class_query = "SELECT * FROM `school_class` WHERE id = $class_id";
      $class = $db->getrow($class_query);

      if ($class) {
          $subject['class_id'] = $teacher;
      }
  }

  return api_ok($subjects);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  /*DELETE*/
  if (isset($_POST['action'])) {
    $action = $_POST['action'];
    if ($action === 'delete' && isset($_POST['id'])) {
      $id = $_POST['id'];

      $delete_query = $db->Execute('DELETE FROM `school_teacher_subject` WHERE `id` = '.$id.'');

      if ($delete_query) {
        return api_ok(['message' => 'Data deleted successfully']);
      } else {
        return api_no(['message' => 'Failed to delete data']);
      }
    }
  }

  $result = ['message' => 'Name parameter is missing'];
  if (isset($_POST['teacher_id']) || isset($_POST['course_id']) || isset($_POST['class_id'])) {
    $teacher_id = $_POST['teacher_id'];
    $course_id  = $_POST['course_id'];
    $class_id   = $_POST['class_id'];

    /*UPDATE*/
    if (isset($_POST['id'])) {
      $id = $_POST['id'];

      $subject_id = $db->getone("SELECT `id` FROM `school_teacher_subject` WHERE `id` = $id");

      if (!$subject_id) {
          return api_no(['message' => 'ID not found']);
      }

      $update_data = [];
      if (isset($teacher_id)) {
        $update_data['teacher_id'] = $teacher_id;
      }
      if (isset($course_id)) {
        $update_data['course_id'] = $course_id;
      }
      if (isset($class_id)) {
        $update_data['class_id'] = $class_id;
      }

      if (empty($update_data)) {
        return api_no(['message' => 'No data to update']);
      }

      $subject_update = $db->Update('school_teacher_subject', $update_data, $id);

      if (!$subject_update) {
        return api_no(['message' => 'Failed to update data']);
      }

      $result = [
        'message'        => 'Data update successful',
        'id'             => $id,
        'data_updated_fields' => $update_data
      ];
      return api_ok($result);
    }

    /*INSERT*/
    if (!isset($_POST['id']))
    {
      $missing_fields = [];
      if (!isset($_POST['teacher_id'])) {
        $missing_fields[] = 'teacher_id';
      }
      if (!isset($_POST['course_id'])) {
        $missing_fields[] = 'course_id';
      }
      if (!isset($_POST['class_id'])) {
        $missing_fields[] = 'class_id';
      }
      if (!empty($missing_fields)) {
        $message = 'Required field(s) missing or incomplete: ' . implode(', ', $missing_fields);
        return api_no(['message' => $message]);
      }
      $course_insert = $db->Insert('school_teacher_subject', [
        'teacher_id' => $teacher_id,
        'course_id'  => $course_id,
        'class_id'   => $class_id
      ]);
      $result = [
        'message' => 'data insert succes',
        'id'         => $id,
        'teacher_id' => $teacher_id,
        'course_id'  => $course_id,
        'class_id'   => $class_id
      ];
      return api_ok($result);
    }
  } else {
    return api_no($result);
  }
}