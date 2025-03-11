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

$studentId = $db->getOne("SELECT `id` FROM `school_student` WHERE `user_id` = $user->id");

// Mengambil data profil siswa
$profileData = $db->getRow("SELECT * FROM `school_student` WHERE `id` = $studentId");
$nis_student = $profileData['nis'] ?? 'Tidak ditemukan';
$nisn_student = $profileData['nisn'] ?? 'Tidak ditemukan';

//nama siswa per kata
$name = htmlspecialchars($profileData['name'] ?? 'Tidak ditemukan');
$nameParts = explode(" ", $name); 
$firstName = $nameParts[0];  
$middleName = (count($nameParts) > 2) ? implode(" ", array_slice($nameParts, 1, -1)) : '';
$lastName = end($nameParts); 

// Mengambil data nilai siswa (dengan logika perhitungan nilainya)
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

link_js('script.js');
link_js(_ROOT . 'templates/eraport-sdit/js/jspdf.umd.min.js');

include tpl('template_raport.html.php');
