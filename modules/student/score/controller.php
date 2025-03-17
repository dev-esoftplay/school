<?php

if (!defined('_VALID_BBC')) {
    exit('No direct script access allowed');
}

// Pastikan objek $user ada dan memiliki id
if (empty($user->id)) {
    redirect(_URL);
}

// Mengambil ID siswa berdasarkan user_id
$studentId = $db->getOne("SELECT `id` FROM `school_student` WHERE `user_id` = {$user->id}");

// Pastikan $studentId tidak kosong
if (empty($studentId)) {
    echo "Siswa tidak ditemukan.";
    exit;
}

// Mengambil data nama siswa
$studentName = $db->getOne("SELECT `name` FROM `school_student` WHERE `user_id` = {$user->id}");

// Pastikan $studentName tidak kosong
if (empty($studentName)) {
    echo "Nama siswa tidak ditemukan.";
    exit;
}

// Mengambil NISN siswa
$nisn = $db->getOne("SELECT `nisn` FROM `school_student` WHERE `user_id` = {$user->id}");

// Mengambil class_id berdasarkan studentId
$classId = $db->getOne("SELECT `class_id` FROM `school_student_class` WHERE student_id = {$studentId}");

// Pastikan class_id ada sebelum digunakan untuk query lainnya
if (!empty($classId)) {
    // Mengambil label kelas berdasarkan class_id
    $labelClass = $db->getOne("SELECT `label` FROM `school_class` WHERE `id` = {$classId}");
} else {
    echo "Class ID tidak ditemukan.";
    exit;
}

// Mengambil nama kelas berdasarkan class_id
$className = $db->getOne("SELECT `grade` FROM `school_class` WHERE `id` = {$classId}");

if (!empty($labelClass) && !empty($className)) {
    $fullClassName = $className . $labelClass; // Contoh: 1a
} else {
    echo "Grade atau label tidak ditemukan.";
    exit;
}

// Mengambil data guru berdasarkan class_id
$teacherId = $db->getOne("SELECT `teacher_id` FROM `school_class` WHERE `id` = {$classId}");

// Mengambil nama guru berdasarkan teacher_id
$teacherName = $db->getOne("SELECT `name` FROM `school_teacher` WHERE `id` = {$teacherId}");

// Mengambil semester aktif
$currentSemester = $db->getOne("SELECT `semester` FROM `school` WHERE `active` = 1");
if ($currentSemester == 1) {
    $semesterName = 'Ganjil';
} elseif ($currentSemester == 2) {
    $semesterName = 'Genap';
} else {
    $semesterName = 'Semester Tidak Diketahui';
}

// Mengambil pengumuman terbaru
$recentAnnouncement = $db->getAll("SELECT * FROM school_announcement_latest_news");

$academicScores = $db->getAll("
    SELECT 
        s.score, 
        s.course_id, 
        s.teacher_id, 
        c.name AS course_name, 
        t.name AS teacher_name 
    FROM school_score s
    JOIN school_course c ON s.course_id = c.id
    JOIN school_teacher t ON s.teacher_id = t.id
    WHERE s.student_id = {$studentId}
");

function calculateGrade($score) {
    if ($score >= 90) {
        return "A";
    } elseif ($score >= 80) {
        return "B";
    } elseif ($score >= 70) {
        return "C";
    } elseif ($score >= 60) {
        return "D";
    } else {
        return "E";
    }
}

// Menyertakan file JS yang diperlukan
link_js('script.js');
link_js(_ROOT . 'templates/eraport-sdit/js/chart.umd.min.js');

// Memasukkan template halaman
include tpl('page.html.php');

?>

