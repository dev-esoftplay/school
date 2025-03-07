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
$parentId = $db->getOne("SELECT `id` FROM `school_parent` WHERE `user_id` = $user->id");

// Mengambil data profil siswa
$profileData = $db->getRow("SELECT * FROM `school_student` WHERE `id` = $studentId");
$fatherData = $profileData['parent_id_dad'] ?? null;
$motherData = $profileData['parent_id_mom'] ?? null;
$gender = $profileData['gender'] ?? null;

// Menentukan jenis kelamin
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

// Mengambil nama ayah dan ibu dari tabel school_parent
$parentfatherData = $db->getRow("SELECT * FROM `school_parent` WHERE `id` = $fatherData");
$parentmotherData = $db->getRow("SELECT * FROM `school_parent` WHERE `id` = $motherData");
$father_name = $parentfatherData['name'] ?? "Tidak diketahui";
$mother_name = $parentmotherData['name'] ?? "Tidak diketahui";

// Mengambil tanggal lahir guru (jika ada)
$date = $teacher['birthday'] ?? null;
$formatted_date = (new DateTime($date))->format("d F Y");

setlocale(LC_TIME, 'id_ID.UTF-8', 'Indonesian', 'Indonesia');
$formatted_date = strftime('%d %B %Y', strtotime($formatted_date ?? 'now'));

link_js('script.js');

include tpl('page.html.php');
