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

$article = [
    "title" => "Pengumuman Penting dari Kepala Sekolah",
    "description" => "Kepada siswa dan guru yang terhormat, kami dengan senang hati mengumumkan bahwa acara tahunan sekolah akan dilaksanakan bulan depan. Mohon untuk tetap memantau informasi lebih lanjut. Kehadiran wajib untuk semua staf dan siswa.",
    "category" => "Pengumuman Sekolah",
    "read_time" => "2 menit bacaan",
    "image" => "https://img.freepik.com/free-photo/group-students-graduation-gown-standing-campus_1150-11021.jpg",
    "source" => "Kantor Kepala Sekolah",
    "time" => "1 jam yang lalu"
];


$school_news = $db->getAll("SELECT * FROM school_announcement_latest_news");

// Sample Featured News Data
$featured_news = $db->getAll("SELECT * FROM school_announcement_featured_news");

link_js('script.js');

include tpl('page.html.php');
