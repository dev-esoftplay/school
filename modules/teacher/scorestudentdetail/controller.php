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
// $class_id = isset($_GET['class_id']) ? intval($_GET['class_id']) : 0;

// $teacherClass = $db->getAll("
//     SELECT DISTINCT 
//         sc.id, 
//         sc.grade AS kelas, 
//         (SELECT COUNT(*) FROM school_student_class WHERE class_id = sc.id) AS siswa,
//         st.name AS wali_kelas
//     FROM school_class sc
//     LEFT JOIN school_teacher st ON sc.teacher_id = st.id
//     WHERE sc.teacher_id = $teacherId
// ");

link_js('script.js');
link_js(_ROOT . 'templates/eraport-sdit/js/jspdf.umd.min.js');

include tpl('page.html.php');
