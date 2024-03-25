<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$_POST['user_id'] = $user_id;

// replace encode dari salt mobile ke salt server
$_POST['secretkey']     = _class('crypt')->decode($_POST['secretkey'], _SALT_MOBILE);
$_POST['secretkey']     = explode('|', $_POST['secretkey']);
$_POST['secretkey'][0]  = _SALT;
$_POST['secretkey']     = _class('crypt')->encode(implode('|', $_POST['secretkey']));
$username               = $db->getone('SELECT `username` FROM `bbc_user` WHERE `id` = ' . $user_id);
$_POST['username']      = $username;

include _ROOT . 'modules/user/push-token.php';