<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$date           = $_GET['date'];
$student_id     = $_GET['student_id'];
$formatted_date = date('Y-m-d', strtotime($date));

$query = $db->getall('SELECT sa.`schedule_id`, sa.`notes`, sa.`presence` as `status`, st.`name` as `teacher_name`, st.`image`, sc.`name` as mapel, ss.`clock_start`, ss.`clock_end`
                      FROM `school_attendance` sa
                      LEFT JOIN `school_schedule` ss ON sa.`schedule_id` = ss.`id`
                      LEFT JOIN `school_teacher_subject` sts ON ss.`subject_id` = sts.`id`
                      LEFT JOIN `school_teacher` st ON sts.`teacher_id` = st.`id`
                      LEFT JOIN `school_course` sc ON sts.`course_id` = sc.`id`
                      WHERE sa.`student_id` = '. $student_id .' AND 
                      DATE(sa.`created`) = "' . $formatted_date . '"');

return api_ok($query);