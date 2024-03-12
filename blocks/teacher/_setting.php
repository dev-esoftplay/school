<?php  if ( ! defined('_VALID_BBC')) exit('No direct script access allowed');

$_setting = array(
	'limit' => array(
		'text'    => 'Total show',
		'type'    => 'text',
		'default' => '2',
		'tips'    => 'Items to show in block'
		),
	'avatar' => array(
		'text'    => 'Use Avatar',
		'type'    => 'radio',
		'option'  => array('1'=>'yes','0'=>'no'),
		'default' => '1',
		'tips'    => 'Show user avatar'
		),
	);