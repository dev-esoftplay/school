<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$Bbc->token     = '';
$Bbc->limit     = 10;
$Bbc->limit_max = 30; // maksimum limit untuk jaga" dari load data berlebihan

if (isset($_seo['URI']))
{
	if (preg_match('~^(?:www\.)?api\.~is', @$_SERVER['HTTP_HOST']))
	{
		$_seo['r'] = explode('/', $_seo['URI']);

		if (preg_match('~^public_~s', $_seo['r'][0]))
		{
			$Bbc->token = 1;
		}else
		if (!empty($_SERVER['HTTP_TOKEN']))
		{
			$Bbc->token = trim($_SERVER['HTTP_TOKEN']);
		}

		$_seo['URI'] = 'api/'.$_seo['URI'];
	}
}