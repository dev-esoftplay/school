<?php

if (!defined('_VALID_BBC')) {
    exit('No direct script access allowed');
}

// Memeriksa apakah user aktif
$userExist = $db->getOne("SELECT COUNT(*) FROM `bbc_user` WHERE `id` = $user->id AND `active` = 1");

if ($userExist != 1) {
    user_logout($user->id); // Logout jika user tidak aktif
    redirect(_URL); // Redirect ke halaman utama
}

if (empty($user->id)) {
    redirect(_URL); // Redirect jika tidak ada ID pengguna
}

// Mengambil teacher_id berdasarkan user_id
$teacherId = $db->getOne("SELECT `id` FROM `school_teacher` WHERE `user_id` = $user->id");

// Mengambil data dari parameter URL
$class_id = isset($_GET['class_id']) ? intval($_GET['class_id']) : 0;
$student_id = isset($_GET['student_id']) ? intval($_GET['student_id']) : 0;

// Periksa apakah student_id valid
if ($student_id == 0 || $class_id == 0) {
    echo "ID Siswa atau ID Kelas tidak valid.";
    exit;
}

// Menyusun data mata pelajaran dari school_course
$mataPelajaran = $db->getAll("SELECT id, name FROM school_course");

// Menyusun nilai yang sudah ada untuk siswa
$nilaiSiswa = [];
$nilaiQuery = $db->getAll("
    SELECT sc.id AS course_id, sc.name AS course_name, ss.score
    FROM school_score ss
    JOIN school_course sc ON ss.course_id = sc.id
    WHERE ss.student_id = " . intval($student_id)
);

// Menyusun nilai berdasarkan mata pelajaran
foreach ($nilaiQuery as $nilai) {
    $nilaiSiswa[$nilai['course_id']] = $nilai['score'];
}

// Jika nilai tidak ada, tambah nilai kosong pada mata pelajaran
foreach ($mataPelajaran as $mapel) {
    if (!isset($nilaiSiswa[$mapel['id']])) {
        $nilaiSiswa[$mapel['id']] = null;
    }
}

// Menyertakan JavaScript untuk halaman ini
link_js('script.js');
link_js(_ROOT . 'templates/eraport-sdit/js/jspdf.umd.min.js');

// Memuat halaman template
include tpl('page.html.php');
