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
    "title" => "Important Announcement from the Principal",
    "description" => "Dear students and teachers, we are pleased to announce that the annual school event will take place next month. Please stay tuned for further details. Attendance is mandatory for all staff and students.",
    "category" => "School Announcement",
    "read_time" => "2 min read",
    "image" => "https://img.freepik.com/free-photo/group-students-graduation-gown-standing-campus_1150-11021.jpg",
    "source" => "Principal's Office",
    "time" => "1 hour ago"
];

$school_news = $db->getAll("SELECT * FROM school_announcement_latest_news");

// Sample Featured News Data
$featured_news = $db->getAll("SELECT * FROM school_announcement_featured_news");

link_js('script.js');

include tpl('page.html.php');
