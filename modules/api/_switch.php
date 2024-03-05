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

	case 'student_class': // untuk melisting kelas siswa sesuai dengan jadwal yang dipilih guru GET:{"class_id":"1","schedule_id":"1"}
		include 'student_class.php';
		break;

	case 'student_attendance': // untuk memasukkan data absensi siswa POST:{"student_id":"1","schedule_id":"1","status":"1"}
		include 'student_attendance.php';
		break;
		
	case 'teacher_student': // untuk listing siswa di kelas yang diampu wali kelas GET:{"class_id":"1"}
		include 'teacher_student.php';
		break;
		
	case 'student_detail_attendance': // untuk melihat detail siswa dari listing siswa yang diampu wali kelas GET:{"student_id":"1", "month":"1 ?? current(month)", "week":"1 ?? ""}
		include 'student_detail_attendance.php';
		break;

	case 'parent':
		include 'parent.php';
		break;	

	case 'parent_student':
		include 'parent_student.php';
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

	case 'teacher_subject_class': // melisting class guru 
		include 'teacher_subject_class.php';
		break;

	case 'teacher_subject_course': // melisting course guru 
		include 'teacher_subject_course.php';
		break;

	case 'public_login':
		include 'public_login.php';
		break;
	
	case 'teacher_update': // untuk mengubah data guru POST:{"#image":"url imgae"}
		include 'teacher_update.php';
		break;

	case 'teacher_schedule': // melisting jadwal guru GET:{"#date":"","#day":""}
		include 'teacher_schedule.php';
		break;

	case 'teacher_schedule_report': // melisting laporan jadwal guru GET:{"#class_id":"","#course_id":"","#day":"", "#week":"", "#month":""}
		include 'teacher_schedule_report.php';
		break;

	case 'teacher_schedule_class': // melisting jadwal wali kelas 
		include 'teacher_schedule_class.php';
		break;
	
	case 'parent_student': // melisting anak dari orang tua 
		include 'parent_student.php';
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

	case 'user_token':
		include 'user_token.php';
		break;

  case 'no_auth': // tiap API wajib pakai ini
		api_no(lang('Authentication Failed.'));
		break;

	default: // tiap API wajib pakai ini
		api_no(lang('Invalid action <b>%s</b> has been received...', $Bbc->mod['task']));
		break;
}
output_json($output);

