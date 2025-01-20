<?php

if (!defined('_VALID_BBC'))
    exit('No direct script access allowed');

switch ($Bbc->mod['task']) {
    case 'main':
    case 'pagenotfound' :
        include '404.php';
        break;
    case 'forbidden' :
        include '403.php';
        break;
    case 'logout':
        user_logout($user->id);
        redirect(_URL);
        break;
    default:
        echo 'Invalid action <b>' . $Bbc->mod['task'] . '</b> has been received...';
        break;
}
