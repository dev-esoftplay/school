<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
    $query   = 'SELECT * FROM `school_schedule` WHERE `id` = '.$id;
    $schedule = $db->getAssoc($query); 

		if (!$schedule) {
      return api_no(['message' => 'Data not found for the given ID']);
    }

    $subject_id    = $schedule[$id]['subject_id'];
    $subject_query = 'SELECT * FROM `school_teacher_subject` WHERE `id` = '.$subject_id;
    $subject       = $db->getrow($subject_query);

    if (!$subject) {
      return api_no(['message' => 'Subject data not found for the given ID']);
    }

    $teacher_id   = $schedule[$id]['subject_id']['teacher_id'];
    $teacher_data = $db->getrow('SELECT * FROM `school_teacher` WHERE id = '.$teacher_id);
    if (!$teacher_data) {
      return api_no(['message' => 'Teacher data not found for the given ID']);
    }

    $course_id = $schedule[$id]['subject_id']['course_id'];
    $course_data = $db->getrow('SELECT * FROM `school_course` WHERE id = '.$course_id);
    if (!$course_data) {
      return api_no(['message' => 'course data not found for the given ID']);
    }

    $class_id   = $schedule[$id]['subject_id']['class_id'];
    $class_data = $db->getrow('SELECT * FROM `school_class` WHERE id = '.$class_id);
    if (!$class_data) {
      return api_no(['message' => 'class data not found for the given ID']);
    }

    $teacher_name = $teacher_data['name'];

    $schedule[$id]['subject_id']               = $subject;
    $schedule[$id]['subject_id']['teacher_id'] = $teacher_data;
    $schedule[$id]['subject_id']['course_id']  = $course_data;
    $schedule[$id]['subject_id']['class_id']   = $class_data;

		return api_ok($schedule);
	}	

  $query = "SELECT * FROM `school_schedule` WHERE 1";
	$schedules = $db->getall($query);

  if (!$schedules) {
    return api_no(['message' => 'Data not found or empty']);
  }

  foreach ($schedules as &$schedule) {
    $subject_id = $schedule['subject_id'];
    $subject_query = 'SELECT * FROM `school_teacher_subject` WHERE `id` = '.$subject_id;
    $subject = $db->getrow($subject_query);

    if ($subject) {
      $schedule['subject_id'] = $subject;
    } 

    $teacher_id = $schedule['subject_id']['teacher_id'];
    $teacher_query = 'SELECT * FROM `school_teacher` WHERE `id` = '.$teacher_id;
    $teacher = $db->getrow($teacher_query);

    if ($teacher) {
      $schedule['subject_id']['teacher_id'] = $teacher;
    }

    $course_id = $schedule['subject_id']['course_id'];
    $course_query = 'SELECT * FROM `school_course` WHERE `id` = '.$course_id;
    $course = $db->getrow($course_query);

    if ($course) {
      $schedule['subject_id']['course_id'] = $course;
    }

    $class_id = $schedule['subject_id']['class_id'];
    $class_query = 'SELECT * FROM `school_class` WHERE `id` = '.$class_id;
    $class = $db->getrow($class_query);

    if ($class) {
      $schedule['subject_id']['class_id'] = $class;
    }

  }

	return api_ok($schedules);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  /*DELETE*/
	if (isset($_POST['action'])) {
  	$action = $_POST['action'];
    if ($action === 'delete' && isset($_POST['id'])) {
      $id = $_POST['id'];

      $delete_query = $db->Execute('DELETE FROM `school_schedule` WHERE `id` = '.$id);

      if ($delete_query) {
        return api_ok(['message' => 'Data deleted successfully']);
      } else {
      	return api_no(['message' => 'Failed to delete data']);
      }
    }
  }

  if (isset($_POST['subject_id']) || isset($_POST['day']) || isset($_POST['clock'])) {
    $subject_id = $_POST['subject_id'];
    $day = $_POST['day'];
    $clock = $_POST['clock'];

    if ($clock) {
      $clock_parse = explode(" - ", $clock);
      if (count($clock_parse) !== 2) {
        return api_no(['message' => 'Invalid class name format']);
      }
      $clock_start = $clock_parse[0];
      $clock_end   = $clock_parse[1];
    }

    if (isset($_POST['id'])) {
      $id = $_POST['id'];
      $schedule_id = $db->getone('SELECT id FROM `school_schedule` WHERE `id` = '.$id);

      if (!$schedule_id) {
        return api_no(['message' => 'Id not Found']);
      };

      $update_data = [];
      if (isset($subject_id)) {
        $update_data['subject_id'] = $subject_id;
      }
      if (isset($day)) {
        $update_data['day'] = $day;
      }
      if (isset($clock_start) && isset($clock_end)) {
        $update_data['clock_start'] = $clock_start;
        $update_data['clock_end']   = $clock_end;
      }

      if (empty($update_data)) {
        return api_no(['message' => 'No data to update']);
      }

      $schedule_update = $db->Update('school_schedule', $update_data, $id);

      if (!$schedule_update) {
        return api_no(['message' => 'Failed to update data']);
      }

      $result = [
        'message'             => 'Data update successful',
        'id'                  => $id,
        'data_updated_fields' => $update_data
      ];
      return api_ok($result);
    } 

    $schedule_insert = $db->Insert('school_schedule', array(
      'subject_id'  => $subject_id,
      'day'         => $days_numeric,
      'clock_start' => $clock_start,
      'clock_end'   => $clock_end
    ));

    $result = [
      'message'     => 'data insert succes',
      'id'          => $db->Insert_ID(),
      'subject_id'  => $subject_id,
      'day'         => $days_numeric,
      'clock_start' => $clock_start,
      'clock_end'   => $clock_end
    ];
    return api_ok($result);

  } else {
    return api_no($result);
  }
}