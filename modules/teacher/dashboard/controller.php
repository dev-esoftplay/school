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

$user_id = $user->id;
$teacher_id = $db->getOne("SELECT id FROM school_teacher WHERE user_id = $user_id", array($user->id));
$position = $db->getOne("SELECT position FROM school_teacher WHERE id = $teacher_id", array($teacher_id));
$classes = $db->getAll("SELECT grade, label FROM school_class WHERE id = $teacher_id", array($teacher_id));
$teacherClasses = $db->getOne("
    SELECT COUNT(*) AS total_classes 
    FROM school_class 
    WHERE teacher_id = $teacher_id", 
    array($teacher_id)
);


// Fetch the summarized data grouped by class_id
$studentCounts = $db->getAll("
    SELECT sc.id AS class_id, sc.grade, sc.label, SUM(ssc.number) AS total_students 
    FROM school_student_class ssc
    JOIN school_class sc ON ssc.class_id = sc.id
    GROUP BY ssc.class_id
");

link_js('script.js');
link_js(_ROOT . 'templates/eraport-sdit/js/chart.umd.min.js');

include tpl('page.html.php');
