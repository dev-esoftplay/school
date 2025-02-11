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

// Ambil ID guru berdasarkan user_id
$teacherId = intval($db->getOne("SELECT `id` FROM `school_teacher` WHERE `user_id` = $user->id"));

// Pastikan $teacherId valid
if ($teacherId <= 0) {
    echo "<p style='color: red;'>Data guru tidak ditemukan.</p>";
    exit;
}

// // Ambil daftar kelas yang diampu oleh guru berdasarkan walikelas
// $teacherlass = $db->getAll("
//     SELECT DISTINCT 
//         sc.id, 
//         sc.grade AS kelas, 
//         (SELECT COUNT(*) FROM school_student_class WHERE class_id = sc.id) AS siswa,
//         st.name AS wali_kelas
//     FROM school_class sc
//     LEFT JOIN school_teacher st ON sc.teacher_id = st.id
//     WHERE sc.teacher_id = $teacherId
// ");

// Ambil daftar kelas yang diampu oleh guru, baik yang jadi wali kelas maupun yang diajar per mapel (jika ada)
$teacherClass = $db->getAll("
    SELECT DISTINCT 
        sc.id, 
        sc.grade AS kelas, 
        sc.label AS label,
        (SELECT COUNT(*) FROM school_student_class WHERE class_id = sc.id) AS siswa,
        st.name AS wali_kelas,
        COALESCE(ts.course_id, NULL) AS course_id,
        COALESCE(c.name, '-') AS course_name
    FROM school_class sc
    LEFT JOIN school_teacher st ON sc.teacher_id = st.id
    LEFT JOIN school_teacher_subject ts ON ts.teacher_id = st.id
    LEFT JOIN school_course c ON ts.course_id = c.id
    LEFT JOIN school_teacher_subject ssc ON sc.id = ssc.class_id
    WHERE (ssc.teacher_id = $teacherId OR sc.teacher_id = $teacherId);
");

link_js('script.js');
link_js(_ROOT . 'templates/eraport-sdit/js/jspdf.umd.min.js');

include tpl('page.html.php');
