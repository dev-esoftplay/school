<?php
if (!defined('_VALID_BBC')) exit('No direct script access allowed');

// Memeriksa apakah user aktif
$userExist = $db->getOne("SELECT COUNT(*) FROM `bbc_user` WHERE `id` = $user->id AND `active` = 1");
if ($userExist != 1 || empty($user->id)) {
    user_logout($user->id);
    redirect(_URL); 
}

// Mengambil teacher_id berdasarkan user_id
$teacherId = $db->getOne("SELECT `id` FROM `school_teacher` WHERE `user_id` = " . intval($user->id));

// Mengambil data dari parameter URL
$class_id = isset($_GET['class_id']) ? intval($_GET['class_id']) : 0;
$student_id = isset($_GET['student_id']) ? intval($_GET['student_id']) : 0;
if ($student_id == 0 || $class_id == 0) exit("ID Siswa atau ID Kelas tidak valid.");

// Mengambil nama siswa dan mata pelajaran
$student_name = $db->getOne("SELECT name FROM school_student WHERE id = $student_id");
$mataPelajaran = $db->getAll("SELECT id, name FROM school_course");

// Mengambil nilai yang sudah ada untuk siswa
$nilaiSiswa = [];
$nilaiQuery = $db->getAll("SELECT course_id, score FROM school_score WHERE student_id = $student_id");
foreach ($nilaiQuery as $nilai) {
    $nilaiSiswa[$nilai['course_id']] = $nilai['score'];
}

// Ambil data bobot nilai dan pilih yang sesuai dengan type_id sebelumnya
$scoreWeights = $db->getAll("SELECT id, name FROM school_score_cat");
$selectedWeightId = $db->getOne("SELECT type_id FROM school_score WHERE student_id = $student_id LIMIT 1") ?: 1;

// Menyusun opsi dropdown untuk bobot nilai
$scoreWeightsOptions = '';
foreach ($scoreWeights as $scoreWeight) {
    $selected = ($scoreWeight['id'] == $selectedWeightId) ? 'selected' : '';
    $scoreWeightsOptions .= "<option value='{$scoreWeight['id']}' $selected>{$scoreWeight['name']}</option>";
}

// Menyimpan nilai jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $selectedWeightId = $_POST['score_weight'] ?? 0;
    if ($selectedWeightId <= 0) exit("Bobot nilai tidak valid!");

    foreach ($mataPelajaran as $mapel) {
        $score = $_POST[$mapel['id']] ?? null;
        if ($score !== null) {
            $existingScore = $db->getOne("SELECT COUNT(*) FROM school_score WHERE student_id = $student_id AND course_id = {$mapel['id']}");
            $query = $existingScore > 0 ?
                "UPDATE school_score SET score = $score, type_id = $selectedWeightId WHERE student_id = $student_id AND course_id = {$mapel['id']}" :
                "INSERT INTO school_score (student_id, teacher_id, course_id, score, type_id, semester) VALUES ($student_id, $teacherId, {$mapel['id']}, $score, $selectedWeightId, 1)";
            $db->execute($query);
        }
    }
    redirect("teacher/scoredetail?class_id=$class_id&student_id=$student_id");
}

// Memuat halaman template
include tpl('page.html.php');
