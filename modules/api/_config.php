<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$Bbc->user_id    = 0;
$Bbc->api_public = 0;
$Bbc->limit      = 10;
$Bbc->limit_max  = 30; // maksimum limit untuk jaga" dari load data berlebihan

if (isset($_seo['URI']))
{
	if (preg_match('~^(?:www\.)?api\.~is', @$_SERVER['HTTP_HOST']))
	{
		$_seo['r'] = explode('/', $_seo['URI']);

		if (preg_match('~^public_~s', $_seo['r'][0]))
		{
			$Bbc->user_id       = 1;
			$Bbc->api_public       = 1;
			$_SERVER['HTTP_TOKEN'] = 1;
		}else
		if (!empty($_SERVER['HTTP_TOKEN']))
		{
			$token = _class('crypt')->decode(trim($_SERVER['HTTP_TOKEN']));
			if (!empty($token))
			{
				@list($timestamp, $user_id, $teacher_id) = explode('|', $token);	

				if (!empty($timestamp))
				{
					if ($timestamp > strtotime('-5 MINUTES'))
					{
						if(!empty($user_id))
						{
							$Bbc->user_id = intval($user_id);
						}
						if(!empty($teacher_id))
						{
							$Bbc->teacher_id = intval($teacher_id);
						}
					}
				}
			}
		}

		$Bbc->user_args = explode('/', $_seo['URI']);
		$_seo['URI']    = 'api/'.$_seo['URI'];
	}
}