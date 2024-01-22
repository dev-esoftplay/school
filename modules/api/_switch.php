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

	case 'student_class': // untuk melisting kelas siswa sesuai dengan jadwal yang dipilih guru
		include 'student_class.php';
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
	
	case 'teacher_update': // untuk mengubah data guru POST:{"#image":"url imgae"}
		include 'teacher_update.php';
		break;

	case 'teacher_course': 
		include 'teacher_course.php';
		break;

	case 'teacher_schedule': // untuk melisting jadwal guru 
		include 'teacher_schedule.php';
		break;

	case 'public_image_upload': // untuk mengupload gambar yang akan disimpan ke database FILE:{"image"}
	case 'image_upload': // untuk mengupload gambar yang akan disimpan ke database FILE:{"image"}
		include 'image_upload.php';
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