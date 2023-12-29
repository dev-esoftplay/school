<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');
// Module ini digunakan untuk mengatur semua content anda, dimana content itu sendiri terdiri dari artikel, galeri, file download, video maupun audio untuk pengunjung situs
switch( $Bbc->mod['task'] )
{
	case 'main': // melihat daftar school
	case 'school':
		include 'school.php';
		break;
	case 'school':
		include 'school.php';
		break;

}
output_json($output);