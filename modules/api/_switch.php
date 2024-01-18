<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');
// Module ini digunakan untuk mengatur semua content anda, dimana content itu sendiri terdiri dari artikel, galeri, file download, video maupun audio untuk pengunjung situs
switch( $Bbc->mod['task'] )
{
	case 'main': // melihat daftar school

	case 'school':
		include 'school.php';
		break;

	case 'teacher':
		include 'teacher.php';
		break;

	case 'student':
		include 'student.php';
		break;

	case 'parent':
		include 'parent.php';
		break;

	case 'course':
		include 'course.php';
		break;

	case 'class':
		include 'class.php';
		break;

	case 'schedule':
		include 'schedule.php';
		break;

	case 'subject':
		include 'subject.php';
		break;

	case 'public_login':
		include 'public_login.php';
		break;
	
	case 'teacher_update':
		include 'teacher_update.php';
		break;

	case 'teacher_course':
		include 'teacher_course.php';
		break;

	case 'teacher_schedule':
		include 'teacher_schedule.php';
		break;

	case 'teacher_upload_image':
		include 'teacher_upload_image.php';
		break;

 	case 'logout': // Halaman untuk logout bagi user yang sudah login
    user_logout($Bbc->user_id);
    redirect(_URL);
    break;


  case 'push-token': // untuk replace generate push_id notif
		include 'push-token.php';
		break;
  case 'no_auth': // tiap API wajib pakai ini
		api_no(lang('Authentication Failed.'));
		break;
	default: // tiap API wajib pakai ini
		api_no(lang('Invalid action <b>%s</b> has been received...', $Bbc->mod['task']));
		break;
}
output_json($output);