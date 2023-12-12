<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

// Module untuk menampilkan list dari orang tua dari siswa
switch( $Bbc->mod['task'] )
{ 
	case 'main': // daftar testimoni user yang telah masuk
	case 'list': // alias dari task "main"
		include 'list.php';
		break; 
	case 'list_detail':
		include 'list_detail.php';
		break;

	default:
		echo 'Invalid action <b>'.$Bbc->mod['task'].'</b> has been received...';
		break;
}