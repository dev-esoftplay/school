<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');
if ($parent_id)
{
  $parent_data = $db->getrow('SELECT `id`, `name`, `phone` FROM `school_parent` WHERE `id` = ' . $parent_id);
  $student_ids = $db->getcol('SELECT `student_id` FROM `school_student_parent` WHERE `parent_id` = ' . $parent_id);
  
  $student_data = [];
  foreach ($student_ids as $student_id) 
  {
    $first_date                 = $db->getone('SELECT `created` FROM `school_attendance` WHERE `student_id` = ' . $student_id . ' ORDER BY created ASC LIMIT 1');
    $one_year_later             = date('Y-m-d', strtotime('+1 year', strtotime($first_date)));
    $attendance_presence_report = $db->getall('SELECT `presence`, COUNT(*) as `count` FROM `school_attendance` WHERE `student_id` = ' . $student_id . ' AND `created` BETWEEN "' . $first_date . '" AND "' . $one_year_later . '" GROUP BY presence');

    $student_info = $db->getrow('SELECT `id`, `name`, `birthday`, `nis`, `image` FROM `school_student` WHERE `id` = ' . $student_id);
    $class_id     = $db->getone('SELECT `class_id` FROM `school_student_class` WHERE `student_id` = '. $student_id);
    $class_name   = $db->getone('SELECT CONCAT_WS(" ", `grade`, `major`, `label`) FROM `school_class` WHERE `id`=' . $class_id);
    $teacher      = $db->getone('SELECT `teacher_id` FROM `school_class` WHERE `id` = ' . $class_id);
    $teacher_data = $db->getrow('SELECT `name`, `phone` FROM `school_teacher` WHERE `id` = ' . $teacher);
    
    // Initialize the array with default values
    $attendance_report_data = ['hadir' => 0, 'sakit' => 0, 'ijin' => 0, 'tidak_hadir' => 0];
    foreach ($attendance_presence_report as $data) 
    {
      switch ($data['presence']) 
      {
        case 1:
          $attendance_report_data['hadir'] = $data['count'];
          break;
        case 2:
          $attendance_report_data['sakit'] = $data['count'];
          break;
        case 3:
          $attendance_report_data['ijin'] = $data['count'];
          break;
        case 4:
          $attendance_report_data['tidak_hadir'] = $data['count'];
          break;
      }
    }

    $student_data[] = [
      "student_id"          => intval($student_info['id']),
      "student_name"        => $student_info['name'],
      "birthday"            => $student_info['birthday'],
      "nis"                 => $student_info['nis'],
      "teacher_name"        => ($teacher_data != null) ? $teacher_data['name'] : '',
      "teacher_phone"       => ($teacher_data != null) ? $teacher_data['phone'] : '',
      "class_id"            => $class_id,
      "class_name"          => $class_name ? $class_name : '',
      "student_image"       => api_image_url($student_info['image'], $student_id, 'school/student') ?? '',
      "student_attendance"  => $attendance_report_data
    ];
  }
  
  $parent_data = array(
    "parent_id"     => intval($parent_data['id']),
    "name"          => $parent_data['name'],
    "phone"         => $parent_data['phone'],
    "student_data"  => $student_data,
  );
  
  return api_ok($parent_data);
}else
{
  return api_no('Data orang tua tidak ditemukan.');
}