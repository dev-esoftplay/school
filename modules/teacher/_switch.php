<?php

if (!defined('_VALID_BBC'))
    exit('No direct script access allowed');

switch ($Bbc->mod['task']) {
    case 'main':
        include 'controller.php';
        break;
    case 'dashboard':
        include 'dashboard/controller.php';
        break;
    case 'class':
        include 'class/controller.php';
        break;
    case 'score':
        include 'score/controller.php';
        break;
    case 'announcement':
        include 'announcement/controller.php';
        break;
    case 'profile':
        include 'profile/controller.php';
        break;
    case 'scoredetail':
         include 'scoredetail/controller.php';
        break;
    case 'scorestudentdetail':
        include 'scorestudentdetail/controller.php';
        break;
    case 'inputnilai':
         include 'input_nilai/controller.php';
        break;
    case 'logout':
        user_logout($user->id);
        redirect(_URL);
        break;
    default:
        redirect(_URL . 'error/pagenotfound');
        break;
}
