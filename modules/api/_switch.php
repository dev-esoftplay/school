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

}
output_json($output);