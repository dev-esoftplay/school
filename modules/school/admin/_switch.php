<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

// Module ini digunakan untuk mengatur semua content anda, dimana content itu sendiri terdiri dari artikel, galeri, file download, video maupun audio untuk pengunjung situs
switch ($Bbc->mod['task']) {
	case 'main': // melihat daftar school
	case 'school':
		include 'modules/school/school.php';
		break;

	case 'student':
		include 'modules/student/student.php';
		break;

	case 'student_edit':
		include 'modules/student/student_edit.php';
		break;

	case 'student_add':
		include 'modules/student/student_add.php';
		break;

	case 'student_class':
		include 'modules/student_class/student_class.php';
		break;

	case 'student_class_add':
		include 'modules/student_class/student_class_add.php';
		break;

	case 'teacher':
		include 'modules/teacher/teacher.php';
		break;

	case 'teacher_edit':
		include 'modules/teacher/teacher_edit.php';
		break;

	case 'teacher_add':
		include 'modules/teacher/teacher_add.php';
		break;

	case 'class':
		include 'modules/class/class.php';
		break;

	case 'class_add':
		include 'modules/class/class_add.php';
		break;

	case 'class_edit':
		include 'modules/class/class_edit.php';
		break;

	case 'schedule':
		include 'modules/schedule/schedule.php';
		break;

	case 'schedule_add':
		include 'modules/schedule/schedule_add.php';
		break;

	case 'schedule_edit':
		include 'modules/schedule/schedule_edit.php';
		break;

	case 'subject':
		include 'modules/subject/subject.php';
		break;

	case 'subject_add':
		include 'modules/subject/subject_add.php';
		break;

	case 'subject_edit':
		include 'modules/subject/subject_edit.php';
		break;

	case 'parent':
		include 'modules/parent/parent.php';
		break;

	case 'parent_edit':
		include 'modules/parent/parent_edit.php';
		break;

	case 'attendance':
		include 'modules/attendance/attendance.php';
		break;

	case 'attendance_edit':
		include 'modules/attendance/attendance_edit.php';
		break;

	case 'notification':
		include 'modules/notification/notification.php';
		break;

	case 'course':
		include 'modules/course/course.php';
		break;

	case 'course_add':
		include 'modules/course/course_add.php';
		break;

	case 'course_edit':
		include 'modules/course/course_edit.php';
		break;

	case 'clock':
		include 'modules/clock/clock.php';
		break;

	case 'clock_add':
		include 'modules/clock/clock_add.php';
		break;

	case 'class_student':
		include 'modules/class_student/class_student.php';
		break;

	case 'semester':
		include 'modules/semester/semester.php';
		break;

	case 'score':
		include 'modules/score/score.php';
		break;

	case 'profile':
		include 'modules/profile/profile.php';
		break;
}
