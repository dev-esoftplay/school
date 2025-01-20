<?php

if (!defined('_VALID_BBC'))
    exit('No direct script access allowed');

if (empty($user->id)) {
    redirect(_URL);
}

if (strpos($user->group_id, '5') !== false) {
    redirect(_URL . 'teacher');
} else if (strpos($user->group_id, '7') !== false) {
    redirect(_URL . 'student');
} else {
    redirect(_URL . 'error/forbidden');
}

redirect(_URL . 'error/pagenotfound');

