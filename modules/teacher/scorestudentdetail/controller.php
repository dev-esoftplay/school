<?php

if (!defined('_VALID_BBC')) {
    exit('No direct script access allowed');
}

$userExist = $db->getOne("SELECT COUNT(*) FROM bbc_user WHERE `id` = $user->id AND `active` = 1");

if ($userExist != 1) {
    user_logout($user->id);
    redirect(_URL);
}

if (empty($user->id)) {
    redirect(_URL);
}


// Get teacher ID based on the user
$teacherId = $db->getOne("SELECT `id` FROM `school_teacher` WHERE `user_id` = " . intval($user->id));

// Get the student ID from GET parameter
$student_id = isset($_GET['student_id']) ? intval($_GET['student_id']) : 0;

// Check if student_id is valid before using it in the query
if ($student_id == 0) {
    // Handle invalid or missing student_id, perhaps redirect or show an error
    echo "Invalid student ID.";
    exit;
}

// Retrieve data from the school_score, school_score_cat, school_course, school_student, school_student_class, and school_teacher tables
$data = $db->getAll("
    SELECT 
        ss.id AS score_id,
        ss.score,
        ss.type_id,
        sc.name AS course_name,
        ss.student_id,
        st.name AS student_name,
        stc.grade,
        stc.label AS class_label,
        stc.teacher_id,
        t.name AS teacher_name
    FROM school_score ss
    JOIN school_course sc ON ss.course_id = sc.id
    JOIN school_student st ON ss.student_id = st.id
    JOIN school_class stc ON st.id = stc.teacher_id
    JOIN school_teacher t ON stc.teacher_id = t.id
    WHERE ss.student_id = " . intval($student_id));

// Include necessary JS scripts
    $data = $db->getAll("
    SELECT 
        sc.id AS course_id,
        sc.name AS course_name,
        COALESCE(SUM(ss.score * ssc.weight) / NULLIF(SUM(ssc.weight), 0), 0) AS total_weighted_score
    FROM school_course sc
    LEFT JOIN school_score ss ON sc.id = ss.course_id AND ss.student_id = " . intval($student_id) . "
    LEFT JOIN school_score_cat ssc ON ss.type_id = ssc.id
    GROUP BY sc.id, sc.name
    ORDER BY sc.name ASC
");

//ambil nama siswa
$student_info = $db->getRow("
    SELECT st.name AS student_name
    FROM school_student st
    WHERE st.id = " . intval($student_id)
);
$student_name = isset($student_info['student_name']) ? $student_info['student_name'] : 'Nama Tidak Diketahui';

// Include necessary JS scripts
link_js('script.js');
link_js(_ROOT . 'templates/eraport-sdit/js/jspdf.umd.min.js');

// Load the page template
include tpl('page.html.php');
