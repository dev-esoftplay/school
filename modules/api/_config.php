<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$Bbc->apikey     = '';
$Bbc->limit     = 10;
$Bbc->limit_max = 30; // maksimum limit untuk jaga" dari load data berlebihan

if (isset($_seo['URI']))
{
	if (preg_match('~^(?:www\.)?api\.~is', @$_SERVER['HTTP_HOST']))
	{
		$_seo['r'] = explode('/', $_seo['URI']);

		if (preg_match('~^public_~s', $_seo['r'][0]))
		{
			$Bbc->apikey = 1;
		}else
		if (!empty($_SERVER['HTTP_TOKEN']))
		{
			$token = _class('crypt')->decode(trim($_SERVER['HTTP_TOKEN']), _SALT_MOBILE);

			if (!empty($token))
			{
				@list($timestamp, $apikey) = explode('|', $token); // jika nambah ini, harus nambah juga di fungsi api_token & di tools
				if ($timestamp > strtotime('-1 MINUTES'))
				{
					if (!empty($apikey)) 
					{
						$Bbc->apikey = $apikey;
					}
				}
				unset($timestamp, $apikey);
			}
			unset($token);
		}

		$_seo['URI'] = 'api/'.$_seo['URI'];
	}
}