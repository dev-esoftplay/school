<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

  /*DETAIL*/
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $subject = $db->getAssoc('SELECT * FROM `school_teacher_subject` WHERE `id` = '. $id);
    
    if (!$subject) {
      return api_no(['message' => 'Data not found for the given ID']);
    }

    $teacher_id = $subject[$id]['teacher_id'];
    $teacher = $db->getrow('SELECT * FROM `school_teacher` WHERE `id` = '. $teacher_id);

    if (!$teacher) {
      return api_no(['message' => 'Teacher data not found for the given ID']);
    }

    $course_id = $subject[$id]['course_id'];
    $course = $db->getrow('SELECT * FROM `school_course` WHERE `id` = '. $course_id);

    if (!$course) {
      return api_no(['message' => 'Course data not found for the given ID']);
    }

    $class_id = $subject[$id]['class_id'];
    $class = $db->getrow('SELECT * FROM `school_class` WHERE `id` = '. $class_id);

    if (!$class) {
      return api_no(['message' => 'Class data not found for the given ID']);
    }

    $class_teacher_id = $subject[$id]['class_id']['teacher_id'];
    $class_teacher    = $db->getrow('SELECT * FROM `school_teacher` WHERE `id` = '. $class_teacher_id);
    $class_guard      = $class_teacher ? $class_teacher['name'] : null;

    $subject[$id]['teacher_id']              = $teacher;
    $subject[$id]['course_id']               = $course;
    $subject[$id]['class_id']                = $class;
    $subject[$id]['class_id']['class_guard'] = $class_guard;

    return api_ok($subject);
  }

  /*GET ALL*/
	$subjects = $db->getall("SELECT * FROM `school_teacher_subject` WHERE 1");

  if (!$subjects) {
    return api_no(['message' => 'Data not found or empty']);
  }

  foreach ($subjects as &$subject) {
    $teacher_id = $subject['teacher_id'];
    $teacher = $db->getrow('SELECT * FROM `school_teacher` WHERE `id` = '.$teacher_id);

    if ($teacher) {
      $subject['teacher_id'] = $teacher;
    }

    $course_id = $subject['course_id'];
    $course = $db->getrow('SELECT * FROM `school_course` WHERE `id` = '.$course_id);

    if ($course) {
      $subject['course_id'] = $course;
    }

    $class_id = $subject['class_id'];
    $class = $db->getrow('SELECT * FROM `school_class` WHERE `id` = '.$class_id);

    if ($class) {
      $subject['class_id'] = $class;
    }

    $class_teacher_id = $subject['class_id']['teacher_id'];
    $class_teacher    = $db->getrow('SELECT * FROM `school_teacher` WHERE `id` = '.$class_teacher_id);
    $class_guard      = $class_teacher ? $class_teacher['name'] : null;

    if ($class_guard) {
      $subject['class_id']['class_guard'] = $class_guard;
    }

    if (!$teacher) {
      return api_no(['message' => 'Teacher data not found for the given ID']);
    }
    if (!$course) {
      return api_no(['message' => 'Course data not found for the given ID']);
    }
    if (!$class) {
      return api_no(['message' => 'Class data not found for the given ID']);
    }
    if (!$class_guard) {
      return api_no(['message' => 'Course data not found for the given ID']);
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

      $subject_id = $db->getone('SELECT id FROM `school_teacher_subject` WHERE `id` = '.$id);
      if (!$subject_id) {
        return api_no(['message' => 'Id not Found']);
      };
      $subject_delete = $db->Execute('DELETE FROM `school_teacher_subject` WHERE `id` = '.$subject_id);

      if ($subject_delete) {
        return api_ok(['message' => 'Data deleted successfully']);
      } else {
        return api_no(['message' => 'Failed to delete data']);
      }
    }
  }

  if (isset($_POST['teacher_id']) || isset($_POST['course_id']) || isset($_POST['class_id'])) {
    $teacher_id = $_POST['teacher_id'];
    $course_id  = $_POST['course_id'];
    $class_id   = $_POST['class_id'];

    $required_params = ['teacher_id', 'course_id', 'class_id'];

    foreach ($required_params as $param) {
      if (!isset($_POST[$param])) {
        return api_no(['message' => "Parameter '$param' is missing"]);
      }
    }


    $subject_row = $db->getrow('SELECT * FROM `school_teacher_subject` WHERE `teacher_id` = '.$teacher_id.' AND `course_id` = '.$course_id.' AND `class_id` = '.$class_id);
    /*UPDATE*/
    if (isset($_POST['id'])) {
      $id = $_POST['id'];

      $subject_id  = $db->getone('SELECT `id` FROM `school_teacher_subject` WHERE `id` = '.$id);

      if (!$subject_id) {
        return api_no(['message' => 'Id not Found']);
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

      if (!$subject_row) {
        $subject_update = $db->Update('school_teacher_subject', $update_data, $id);
      } else {
        return api_no(['message' => 'Mungkin data sudah ada di database']);
      }

      if (!$subject_update) {
        return api_no(['message' => 'Failed to update data']);
      }

      $result = [
        'message'             => 'Data update successful',
        'id'                  => $id,
        'data_updated_fields' => $update_data
      ];
      return api_ok($result);
    }

    /*INSERT*/
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

    // $subject_row = $db->getrow("SELECT * FROM `school_teacher_subject` WHERE `teacher_id` = '$teacher_id' AND `course_id` = '$course_id' AND `class_id` = '$class_id'");

    if (!$subject_row) {
      $subject_insert = $db->Insert('school_teacher_subject', [
        'teacher_id' => $teacher_id,
        'course_id'  => $course_id,
        'class_id'   => $class_id
      ]);
    } else {
      return api_no(['message' => 'Mungkin data sudah ada di database']);
    }

    if (!$subject_insert) {
      return api_no(['message' => 'Failed to insert data']);
    }

    $result = $db->getrow('SELECT * FROM `school_teacher_subject` WHERE `id` = ' . $db->Insert_ID());
    return api_ok([
      'message' => 'Data Insert Succes',
      $result
    ]);

  } else {
    return api_no($result);
  }
}