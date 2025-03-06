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

$school_news = $db->getAll("SELECT * FROM school_announcement_latest_news");

function limitWords($text, $limit = 8) {
    $words = explode(" ", $text);
    return count($words) > $limit ? implode(" ", array_slice($words, 0, $limit)) . "..." : $text;
}

link_js('script.js');
link_js(_ROOT . 'templates/eraport-sdit/js/chart.umd.min.js');

include tpl('latest-news.html.php');
