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

// Set $teacherId based on $user->id
if ($user->id == 9) {
    $teacher_Id = 1; // Hardcoded value for user ID 9
}
$teacherData = $db->getAll("SELECT * FROM `school_teacher` WHERE `id` = $teacher_Id");
$student_name = $db->getOne("SELECT `name` FROM `school_student` WHERE `user_id` = $user->id");
$classes = $db->getRow("SELECT grade, label FROM school_class WHERE id = $teacher_Id", array($teacher_Id));
$current_semester = $db->getOne("SELECT `semester` FROM `school` WHERE `active` = 1");
$recent_announcement = $db->getAll("SELECT * FROM school_announcement_latest_news");

link_js('script.js');
link_js(_ROOT . 'templates/eraport-sdit/js/chart.umd.min.js');

include tpl('page.html.php');
