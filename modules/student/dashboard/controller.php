<?php

if (!defined('_VALID_BBC'))
    exit('No direct script access allowed');

$userExist = $db->getOne("SELECT COUNT(*) FROM `bbc_user` WHERE `id` = $user->id AND `active` = 1");

if ($userExist != 1) {
    user_logout($user->id);
    redirect(_URL);
}

if (empty($user->id)) {
    redirect(_URL);
}

$teacherId = $db->getOne("SELECT `id` FROM `school_teacher` WHERE `user_id` = $user->id");

$student_name = $db->getOne("SELECT `name` FROM `school_student` WHERE `user_id` = $user->id");
$student_class = "Grade 10-A";
$homeroom_teacher = "Ms. Jane Smith";
$current_semester = "Semester 1, 2023";
$recent_activities = [
    ["title" => "Math Assignment Submitted", "date" => "2023-10-15"],
    ["title" => "Science Quiz Completed", "date" => "2023-10-14"],
    ["title" => "Parent-Teacher Meeting", "date" => "2023-10-10"]
];

link_js('script.js');
link_js(_ROOT . 'templates/eraport-sdit/js/chart.umd.min.js');

include tpl('page.html.php');
