<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$sys->set_layout('blank');
switch ($Bbc->mod['task'])
{
	case main: // Untuk menampilkan halaman utama 
        case login:
            $sys->set_layout('login');
            break;

	default:
		echo 'Invalid action <b>'.$Bbc->mod['task'].'</b> has been received...';
		break;
}
