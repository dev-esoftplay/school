<?php
if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$data_post = [ 'student_id','presence', 'notes', 'schedule_id'];

if ($teacher_id) 
{
  $data = array();

  foreach ($data_post as $value) 
  {
    if (isset($_POST[$value])) {
      $data[$value] = addslashes($_POST[$value]);
    } else {
      return api_no(['message' => 'Missing ' . $value . ' in POST data']);
    }
  }

  $attendance_data = array(
    'student_id'  => $data['student_id'],
    'schedule_id' => $data['schedule_id'],
    'presence'    => $data['presence'],
    'notes'       => $data['notes'],
  );

  // Insert data into the `attendance` table
  // Make sure you have a valid $db object and a proper connection before this point
  $db->insert('school_attendance', $attendance_data);

  return api_ok(['message' => 'Data added successfully']);
} else {
    return api_no(['message' => 'Unauthorized access. Teacher ID is missing.']);
}
