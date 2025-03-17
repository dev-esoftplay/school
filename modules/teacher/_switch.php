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
        include 'score/score-controller.php';
        break;
    case 'announcement':
        include 'announcement/controller.php';
        break;
    case 'latestnews':
        include 'latest-news/latest-news-controller.php';
        break;
    case 'featurednews':
        include 'featured-news/controller.php';
        break;
    case 'profile':
        include 'profile/controller.php';
        break;
    case 'scoredetail':
         include 'score/scoredetail-controller.php';
        break;
    case 'scorestudentdetail':
        include 'score/scorestudent-controller.php';
        break;
    case 'inputnilai':
         include 'input_nilai/controller.php';
        break;
    case 'classdetail':
        include 'classdetail/controller.php';  
        break;
    case 'inputweight':
        include 'input_weight/controller.php';
        break;
    case 'newsdetailpage':
        include 'latest-news/detail-news-controller.php';
        break;
    case 'logout':
        user_logout($user->id);
        redirect(_URL);
        break;
    default:
        redirect(_URL . 'error/pagenotfound');
        break;
}
