<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

// Menampilkan Contact Us dan jika ingin membahkan sosmed di folde blocks/sosmed/_setting.php
$output = array();


include tpl(@$config['template'] . '.html.php', 'default.html.php');
