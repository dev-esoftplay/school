<?php


if (!defined('_VALID_BBC'))
    exit('No direct script access allowed');

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
$teacherId = $db->getOne("SELECT `id` FROM `school_teacher` WHERE `user_id` = " . intval($user->id));

// Mengambil data dari parameter URL
$class_id = isset($_GET['class_id']) ? intval($_GET['class_id']) : 0;
$student_id = isset($_GET['student_id']) ? intval($_GET['student_id']) : 0;

// Periksa apakah student_id valid
if ($student_id == 0 || $class_id == 0) {
    echo "ID Siswa atau ID Kelas tidak valid.";
    exit;
}

// Mengambil nama siswa berdasarkan student_id
$student_info = $db->getRow("SELECT st.name AS student_name FROM school_student st WHERE st.id = " . intval($student_id));
$student_name = isset($student_info['student_name']) ? $student_info['student_name'] : 'Nama Tidak Diketahui';

// Menyusun data mata pelajaran dari school_course
$mataPelajaran = $db->getAll("SELECT id, name FROM school_course");

// Menyusun nilai yang sudah ada untuk siswa
$nilaiSiswa = [];
$nilaiQuery = $db->getAll("SELECT sc.id AS course_id, sc.name AS course_name, ss.score
    FROM school_score ss
    JOIN school_course sc ON ss.course_id = sc.id
    WHERE ss.student_id = " . intval($student_id));

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

// Menyimpan nilai jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($mataPelajaran as $mapel) {
        $score = isset($_POST[$mapel['id']]) ? intval($_POST[$mapel['id']]) : null;

        // Jika nilai tidak null (valid)
        if ($score !== null) {
            // Mengecek apakah nilai sudah ada di tabel
            $existingScore = $db->getOne("SELECT COUNT(*) FROM school_score WHERE student_id = $student_id AND course_id = {$mapel['id']}");

            if ($existingScore > 0) {
                // Jika nilai sudah ada, update nilai
                $db->execute("UPDATE school_score SET score = $score WHERE student_id = $student_id AND course_id = {$mapel['id']}");
            } else {
                // Jika nilai belum ada, insert nilai baru
                $db->execute("INSERT INTO school_score (student_id, teacher_id, course_id, score, type_id, semester)
                              VALUES ($student_id, $teacherId, {$mapel['id']}, $score, 1, 1)");
            }
        }
    }

    // Redirect setelah menyimpan data
    redirect("teacher/scoredetail?class_id=$class_id&student_id=$student_id");
}

// Menyertakan JavaScript untuk halaman ini
link_js('script.js');
link_js(_ROOT . 'templates/eraport-sdit/js/jspdf.umd.min.js');

// Memuat halaman template
include tpl('page.html.php');
?>
