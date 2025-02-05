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

$user_id = intval($user->id); // Pastikan user_id dalam bentuk angka
$sql = sprintf("SELECT * FROM school_teacher WHERE user_id = %d", $user_id);
$teacher = $db->getRow($sql); // Ambil data guru berdasarkan user_id

// Pastikan $teacher ada sebelum mengambil gender
$gender = $teacher['gender'] ?? null;

// Konversi gender ke teks yang mudah dibaca
switch ($gender) {
    case 1:
        $gender_text = "Laki-laki";
        break;
    case 2:
        $gender_text = "Perempuan";
        break;
    default:
        $gender_text = "Tidak diketahui";
        break;
}

setlocale(LC_TIME, 'id_ID.utf8');
$date = $teacher['birthday'] ?? null;
$formatted_date = (new DateTime($date))->format("d F Y");

link_js('script.js');

include tpl('page.html.php');
