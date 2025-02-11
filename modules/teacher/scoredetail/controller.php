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
$class_id = isset($_GET['class_id']) ? intval($_GET['class_id']) : 0;
$className = $db->getOne("SELECT `grade` FROM `school_class` WHERE `id` = $class_id");
$labelClass = $db->getOne("SELECT `label` FROM `school_class` WHERE `id` = $class_id");

if ($class_id <= 0) {
    echo "<p style='color: red;'>Kelas tidak ditemukan.</p>";
    exit;
}

$students = $db->getAll("
    SELECT 
        ssc.id, 
        ssc.student_id, 
        ssc.number, 
        ss.name, 
        ss.nis, 
        ss.gender 
    FROM school_student_class ssc
    JOIN school_student ss ON ssc.student_id = ss.id
    WHERE ssc.class_id = $class_id
");

link_js('script.js');
link_js(_ROOT . 'templates/eraport-sdit/js/jspdf.umd.min.js');

// include tpl('page.html.php');
include tpl('page.html.php', compact('className', 'students', 'labelClass'));
