<?php
if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$data = json_decode($_POST['data'], true);

if ($data === null) 
{
    return api_no(['message' => 'Invalid JSON data']);
}

foreach ($data as $entry) 
{
    $required_fields = ['student_id', 'schedule_id', 'presence', 'notes'];

    foreach ($required_fields as $field) 
    {
        if (!isset($entry[$field])) 
        {
            return api_no(['message' => 'Missing ' . $field . ' in JSON data']);
        }
    }
}

foreach ($data as $entry) 
{
  $query          = 'SELECT `id` FROM school_attendance WHERE student_id = \''.$entry['student_id'].'\' AND schedule_id = \''.$entry['schedule_id'].'\' AND DATE(created) = CURDATE()';
  $result         = $db->execute($query);
  $existing_data  = $result->fetch_assoc();
  if ($existing_data) 
  {
    $db->update(
      'school_attendance',
      [
        'presence'    => addslashes($entry['presence']),
        'notes'       => addslashes($entry['notes']),
      ],
      $existing_data['id']
    );
  }else 
  {
    $attendance_data = array(
      'student_id'  => addslashes($entry['student_id']),
      'schedule_id' => addslashes($entry['schedule_id']),
      'presence'    => addslashes($entry['presence']),
      'notes'       => addslashes($entry['notes']),
    );

    $db->insert('school_attendance', $attendance_data);
  }
}
return api_ok(['message' => 'Data added or updated successfully']);

