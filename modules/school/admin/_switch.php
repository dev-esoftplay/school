<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

// Module ini digunakan untuk mengatur semua content anda, dimana content itu sendiri terdiri dari artikel, galeri, file download, video maupun audio untuk pengunjung situs
switch ($Bbc->mod['task']) {
	case 'main': // melihat daftar school
	case 'school':
		include 'school.php';
		break;

	case 'student':
		include 'student.php';
		break;

	case 'student_edit':
		include 'student_edit.php';
		break;

	case 'student_add':
		include 'student_add.php';
		break;

	case 'student_class':
		include 'student_class.php';
		break;

	case 'student_class_add':
		include 'student_class_add.php';
		break;

	case 'teacher':
		include 'teacher.php';
		break;

	case 'teacher_edit':
		include 'teacher_edit.php';
		break;

	case 'teacher_add':
		include 'teacher_add.php';
		break;

	case 'class':
		include 'class.php';
		break;

	case 'class_add':
		include 'class_add.php';
		break;

	case 'class_edit':
		include 'class_edit.php';
		break;

	case 'schedule':
		include 'schedule.php';
		break;

	case 'schedule_add':
		include 'schedule_add.php';
		break;

	case 'schedule_edit':
		include 'schedule_edit.php';
		break;

	case 'subject':
		include 'subject.php';
		break;

	case 'subject_add':
		include 'subject_add.php';
		break;

	case 'subject_edit':
		include 'subject_edit.php';
		break;

	case 'parent':
		include 'parent.php';
		break;

	case 'parent_edit':
		include 'parent_edit.php';
		break;

	case 'attendance':
		include 'attendance.php';
		break;

	case 'attendance_edit':
		include 'attendance_edit.php';
		break;

	case 'notification':
		include 'notification.php';
		break;

	case 'course':
		include 'course.php';
		break;

	case 'course_add':
		include 'course_add.php';
		break;

	case 'course_edit':
		include 'course_edit.php';
		break;

	case 'clock':
		include 'clock.php';
		break;
		
	case 'clock_add':
		include 'clock_add.php';
		break;
		
	case 'class_student':
		include 'class_student.php';
		break;

	case 'semester':
		include 'semester.php';
		break;
}