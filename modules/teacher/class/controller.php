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


link_js('script.js');

include tpl('page.html.php');
