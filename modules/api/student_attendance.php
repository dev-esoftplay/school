<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

// Assuming you have already retrieved $class_id, $schedule_id, and $student_data
$class_id     = addslashes(intval($_GET['class_id'])); 
$schedule_id  = addslashes(intval($_GET['schedule_id'])); 


// Sample data for illustration purposes, replace with actual data from your request
$attendance_data = array(
    array(
        'student_id' => 1,
        'schedule_id' => $schedule_id,
        'presence'    => 'present',
        'notes'       => 'Student was present.',
    ),
    array(
        'student_id' => 2,
        'schedule_id' => $schedule_id,
        'presence'    => 'absent',
        'notes'       => 'Student was absent.',
    ),
    // Add more entries as needed
);

// Insert data into the `attendance` table
foreach ($attendance_data as $attendance_entry) {
    $db->insert('attendance', $attendance_entry);
}

// Calculate totals for attendance report
$total_present = 0;
$total_s = 0;
$total_i = 0;
$total_a = 0;

foreach ($attendance_data as $attendance_entry) {
    switch ($attendance_entry['presence']) {
        case 'present':
            $total_present++;
            break;
        case 's':
            $total_s++;
            break;
        case 'i':
            $total_i++;
            break;
        case 'a':
            $total_a++;
            break;
        // Add more cases as needed
    }
}

// Sample data for attendance report
$attendance_report_data = array(
    'class_id'      => $class_id,
    'schedule_id'   => $schedule_id,
    'course_id'     => 1, // Replace with the actual course ID
    'total_present' => $total_present,
    'total_s'       => $total_s,
    'total_i'       => $total_i,
    'total_a'       => $total_a,
    'date_day'      => date('d'),
    'date_week'     => date('W'),
    'date_month'    => date('m'),
    'date_year'     => date('Y'),
);

// Insert data into the `attendance_report` table
$db->insert('attendance_report', $attendance_report_data);

// You may return a response indicating success or failure
return api_ok('Data has been successfully posted to attendance and attendance_report tables.');
