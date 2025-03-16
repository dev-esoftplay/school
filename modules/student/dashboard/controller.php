<?php

if (!defined('_VALID_BBC'))
    exit('No direct script access allowed');

// Mengecek apakah user aktif
$userExist = $db->getOne("SELECT COUNT(*) FROM `bbc_user` WHERE `id` = $user->id AND `active` = 1");

if ($userExist != 1) {
    user_logout($user->id);
    redirect(_URL);
}

if (empty($user->id)) {
    redirect(_URL);
}

// Mengambil ID siswa berdasarkan user_id
$studentId = $db->getOne("SELECT `id` FROM `school_student` WHERE `user_id` = $user->id");

// Mengambil data nama siswa
$student_name = $db->getOne("SELECT `name` FROM `school_student` WHERE `user_id` = $user->id");

// Mengambil class_id berdasarkan studentId
$class_id = $db->getOne("SELECT `class_id` FROM `school_student_class` WHERE student_id = $studentId");

// Pastikan class_id ada sebelum digunakan untuk query lainnya
if (!empty($class_id)) {
    // Mengambil label kelas berdasarkan class_id
    $labelClass = $db->getOne("SELECT `label` FROM `school_class` WHERE `id` = $class_id");
} else {
    // Jika class_id tidak ditemukan atau kosong
    echo "Class ID tidak ditemukan.";
}

// Mengambil nama kelas berdasarkan class_id
$className = $db->getOne("SELECT `grade` FROM `school_class` WHERE `id` = $class_id");

// Mengambil data guru berdasarkan class_id
$teacher_id = $db->getOne("SELECT `teacher_id` FROM `school_class` WHERE `id` = $class_id");

// Mengambil nama guru berdasarkan teacher_id
$teacher_Name = $db->getOne("SELECT `name` FROM `school_teacher` WHERE `id` = $teacher_id");

// Debugging: Menampilkan class_id dan labelClass untuk memastikan nilai yang benar
// echo "<pre>";
// echo "Class ID: " . print_r($class_id, true) . "<br>";
// echo "Label Class: " . print_r($labelClass, true) . "<br>";
// echo "Teacher Name: " . print_r($teacher_Name, true) . "<br>";
// echo "</pre>";

// Mengambil semester aktif
$current_semester = $db->getOne("SELECT `semester` FROM `school` WHERE `active` = 1");

// Mengambil pengumuman terbaru
$recent_announcement = $db->getAll("SELECT * FROM school_announcement_latest_news");

// Menyertakan file JS yang diperlukan
link_js('script.js');
link_js(_ROOT . 'templates/eraport-sdit/js/chart.umd.min.js');

// Memasukkan template halaman
include tpl('page.html.php');
