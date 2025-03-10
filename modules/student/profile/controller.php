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

//student name
$name = htmlspecialchars($profileData['name'] ?? 'Tidak ditemukan');
$nameParts = explode(" ", $name); 
$firstName = $nameParts[0];  
$middleName = (count($nameParts) > 2) ? implode(" ", array_slice($nameParts, 1, -1)) : '';
$lastName = end($nameParts);  

//father name
$fa_nameParts = explode(" ", $father_name); 
$fa_firstName = $fa_nameParts[0];  

if (count($fa_nameParts) > 2) {
    $fa_middleName = implode(" ", array_slice($fa_nameParts, 1, -1));
    $fa_lastName = end($fa_nameParts);
} elseif (count($fa_nameParts) === 2) {
    $fa_middleName = '';
    $fa_lastName = $fa_nameParts[1];
} else {
    $fa_middleName = '';
    $fa_lastName = '-'; // Jika hanya ada satu kata
}

//mother name
$mo_nameParts = explode(" ", $mother_name); 
$mo_firstName = $mo_nameParts[0];  

if (count($mo_nameParts) > 2) {
    $mo_middleName = implode(" ", array_slice($mo_nameParts, 1, -1));
    $mo_lastName = end($mo_nameParts);
} elseif (count($mo_nameParts) === 2) {
    $mo_middleName = '';
    $mo_lastName = $mo_nameParts[1];
} else {
    $mo_middleName = '';
    $mo_lastName = '-'; // Jika hanya ada satu kata
}

// Memeriksa gender dan menampilkan gambar yang sesuai
if ($profileData['gender'] == 1) {
    // Gambar untuk gender 1 (Male)
    $imageURL = 'https://imgur.com/0VsSkKI.jpg';  // Ganti dengan link gambar yang sesuai
} else {
    // Gambar untuk gender 2 (Female)
    $imageURL = 'https://imgur.com/Lt6iDTy.jpg';  // Ganti dengan link gambar yang sesuai
}

//photo profil parent
$fatherPhoto = 'https://imgur.com/FZG63Ky.jpg';
$motherPhoto = 'https://imgur.com/yXkwgbw.jpg';

//Memeriksa apakah nomor telepon ayah dan ibu ada
$motherPhoneNumber = $parentmotherData['phone'] ?? "Tidak diketahui"; 
$fatherPhoneNumber = $parentfatherData['phone'] ?? "Tidak diketahui"; 
$formattedMotherPhoneNumber = $motherPhoneNumber !== "Tidak diketahui" ? '+62 ' . substr($motherPhoneNumber, 2, 2) . ' ' . substr($motherPhoneNumber, 4) : "Tidak diketahui";
$formattedFatherPhoneNumber = $fatherPhoneNumber !== "Tidak diketahui" ? '+62 ' . substr($fatherPhoneNumber, 2, 2) . ' ' . substr($fatherPhoneNumber, 4) : "Tidak diketahui";

link_js('script.js');

include tpl('page.html.php');
