<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

// if (isset($_seo['URI'])) {
// 	if ( (preg_match('~^(?:www\.)?api\.~is', @$_SERVER['HTTP_HOST']) || preg_match('~^(?:www\.)?apis\.~is', @$_SERVER['HTTP_HOST'])) and strpos($_seo['URI'], 'v1/mitra') === 0) {
// 		$Bbc->api_uri        = str_replace('v1/mitra', '', $_seo['URI']);
// 		$_seo['break']       = 1; 
// 		$_seo['URI']         = 'api'.$Bbc->api_uri;
// 		$Bbc->api_uri_r      = explode('/', preg_replace('~^\/|\?.*?$~is', '', $Bbc->api_uri));
// 		$Bbc->api_installer  = array();
// 		$Bbc->api_basic      = 0;
// 		$Bbc->api_header     = apache_request_headers();
// 		foreach (@(array)$Bbc->api_header as $key => $value) {
// 			$Bbc->api_header[strtolower($key)] = $value;
// 		}
// 		$Bbc->api_auth_token = (isset($Bbc->api_header['authorization'])) ? preg_replace('~^[a-zA-Z]+\s~is', '', $Bbc->api_header['authorization']) : '' ;
// 		$Bbc->api_auth       = ($Bbc->api_auth_token) ? _class('crypt')->decode($Bbc->api_auth_token) : '';
// 		preg_match('~^([a-zA-Z]+)\s~is', $Bbc->api_auth ? $Bbc->api_header['authorization'] : '' , $Bbc->api_auth_type);
// 		$Bbc->api_auth_type          = ($Bbc->api_auth_type) ? @$Bbc->api_auth_type[1] : '' ;
// 		$Bbc->api_raw_post           = array();
// 		$Bbc->api_get                = array();
// 		$Bbc->api_http_response_code = 0;
// 	}
// }


$Bbc->user_id    = 0;
$Bbc->api_public = 0;
$Bbc->limit     = 10;
$Bbc->limit_max = 30; // maksimum limit untuk jaga" dari load data berlebihan

if (isset($_seo['URI']))
{
	if (preg_match('~^(?:www\.)?api\.~is', @$_SERVER['HTTP_HOST']))
	{
		$_seo['r'] = explode('/', $_seo['URI']);

		if (preg_match('~^public_~s', $_seo['r'][0]))
		{
			$Bbc->api_public       = 1;
			$_SERVER['HTTP_TOKEN'] = 1;
		}else
		if (!empty($_SERVER['HTTP_TOKEN']))
		{
			$token = _class('crypt')->decode(trim($_SERVER['HTTP_TOKEN']));
			if (!empty($token))
			{
				@list($timestamp, $user_id) = explode('|', $token);

				if (!empty($timestamp))
				{
					if ($timestamp > strtotime('-5 MINUTES'))
					{
						if(!empty($user_id))
						{
							$Bbc->user_id = intval($user_id);
						}
					}
				}
			}
		}

		$Bbc->user_args = explode('/', $_seo['URI']);
		$_seo['URI']    = 'api/'.$_seo['URI'];
	}
}