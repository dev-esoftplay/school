<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');
$tables   = [
	'school_attendance',
	'school_attendance_report',
	'school_class',
	'school_clock',
	'school_course',
	'school_parent',
	'school_schedule',
	'school_student',
	'school_student_class',
	'school_student_parent',
	'school_teacher',
	'school_teacher_subject'
];

$tables_with_keys = [];
foreach ($tables as $table) {
	$key = substr($table, strpos($table, '_') + 1);
	$tables_with_keys[$key] = $table;
}

$counts = [];
foreach ($tables as $table) {
	$query          = $db->getOne('SELECT COUNT(*) FROM `' . $table . '`');
	$counts[$table] = $query;
}

if (!empty($_POST['semester'])) {
	$attendance = array();
	$attendance_presence = $db->getall('SELECT s.`id`, s.`name`, s.`birthday`, s.`nis`, s.`address`, s.`nokk`, a.`presence`, COUNT(*) as `count` 
																				FROM `school_student` s 
																				LEFT JOIN `school_attendance` a 
																				ON s.`id` = a.`student_id` 
																				WHERE 1 GROUP BY s.`id`, a.`presence`');

	if (!empty($attendance_presence)) {
		foreach ($attendance_presence as $k => $data) {
			$student_id     = $data['id'];
			$studenet_name  = $data['name'];
			$birthday       = $data['birthday'];
			$nis            = $data['nis'];
			$address        = $data['address'];
			$nokk           = $data['nokk'];
			$presence       = $data['presence'];
			$count          = $data['count'];

			// Initialize attendance data for the student if not already initialized
			if (!isset($attendance[$student_id])) {
				$attendance[$student_id] = array(
					'No'    				=> $k + 1,
					'Student_Name'  => $studenet_name,
					'Birthday'      => $birthday,
					'Nis'           => $nis,
					'Address'       => $address,
					'Nokk'          => $nokk,
					'Hadir'         => 0,
					'Sakit'         => 0,
					'Ijin'          => 0,
					'Tidak_Hadir'   => 0
				);
			}

			// Update attendance data for the student based on presence type
			switch ($presence) {
				case 1:
					$attendance[$student_id]['Hadir'] += $count;
					break;
				case 2:
					$attendance[$student_id]['Sakit'] += $count;
					break;
				case 3:
					$attendance[$student_id]['Ijin'] += $count;
					break;
				case 4:
					$attendance[$student_id]['Tidak_Hadir'] += $count;
					break;
			}
		}
		foreach ($attendance as $student_data) {
			$attend[] = $student_data; // Removed the array wrapping around $student_data
		}
	}

	$attendance_report = $db->getAll('SELECT `sr`.`id` as `no`, 
																`st`.`name` as `teacher_name`,
																`sc`.`name` as `course_name`,
																CONCAT_WS(" ",`scl`.grade,`scl`.label,`scl`.major) AS class_name,
																`total_present`, `total_s`, `total_i`, `total_a` 
																FROM `school_attendance_report` `sr`
																LEFT JOIN `school_teacher` `st` ON `sr`.`teacher_id` = `st`.`id`
																LEFT JOIN `school_course` `sc` ON `sr`.`course_id` = `sc`.`id`
																LEFT JOIN `school_class` `scl` ON `sr`.`class_id` = `scl`.`id`
																WHERE 1
																ORDER BY `sr`.`id` ASC');

	if (!empty($attendance_report)) {
		$attendance_report = array_map(function ($item) {
			return [
				'no' => $item['no'],
				'Guru' => $item['teacher_name'],
				'Mapel' => $item['course_name'],
				'Kelas' => $item['class_name'],
				'Total Hadir' => $item['total_present'],
				'Total Sakit' => $item['total_s'],
				'Total Ijin' => $item['total_i'],
				'Total Tidak Hadir' => $item['total_a']
			];
		}, $attendance_report);
	}

	$class = $db->getall('SELECT `sc`.`id` as `no`, 
										CONCAT_WS(" ",`grade`,`label`,`major`) AS `class_name`, 
										`st`.`name` AS `teacher_guard`
										FROM `school_class` `sc`
										LEFT JOIN `school_teacher` `st` ON `sc`.`teacher_id` = `st`.`id` 
										WHERE 1 
										ORDER BY `sc`.`id` ASC');

	if (!empty($class)) {
		$class = array_map(function ($item) {
			return [
				'no' => $item['no'],
				'Teacher' => $item['teacher_guard'],
				'Kelas' => $item['class_name']
			];
		}, $class);
	}


	$clock = $db->getall('SELECT `id` as `no`, 
									`clock_start` as `jam_mulai`, 
									`clock_end` as `jam_selesai` 
									FROM `school_clock` WHERE 1');
	if (!empty($clock)) {
		$clock = array_map(function ($item) {
			return [
				'no' => $item['no'],
				'Jam Mulai' => $item['jam_mulai'],
				'Jam Selesai' => $item['jam_selesai']
			];
		}, $clock);
	}

	$course = $db->getall('SELECT `id` AS `no`, 
											`name` AS `course_name`
											FROM `school_course` WHERE 1 
											ORDER BY `id` ASC');

	if (!empty($course)) {
		$course = array_map(function ($item) {
			return [
				'no' => $item['no'],
				'Mapel' => $item['course_name']
			];
		}, $course);
	}

	$parent = $db->getAll('SELECT `id` as `no` ,
										`name`,`birthday`,`phone`,`nik`,`nokk`,`address`
										FROM `school_parent` WHERE 1');
	if (!empty($parent)) {
		$parent = array_map(function ($item) {
			return [
				'no' => $item['no'],
				'Nama' => $item['name'],
				'Tanggal Lahir' => $item['birthday'],
				'No HP' => $item['phone'],
				'NIK' => $item['nik'],
				'No KK' => $item['nokk'],
				'Alamat' => $item['address']
			];
		}, $parent);
	}

	$schedule = $db->getAll('SELECT `ss`.`id` as `no`, 
										`ss`.`day` as `hari`, 
										`st`.`name` as `guru`,
										`sc`.`name` as `mapel`,
										CONCAT_WS(" ",`scc`.grade,`scc`.label,`scc`.major) AS class_name,
										`ss`.`clock_start` as `jam_mulai`, 
										`ss`.`clock_end` as `jam_selesai` 
										FROM `school_schedule` `ss` 
										LEFT JOIN `school_teacher_subject` `sts` ON `ss`.`subject_id` = `sts`.`id`
										LEFT JOIN `school_teacher` `st` ON `sts`.`teacher_id` = `st`.`id`
										LEFT JOIN `school_course` `sc` ON `sts`.`course_id` = `sc`.`id`
										LEFT JOIN `school_class` `scc` ON `sts`.`class_id` = `scc`.`id`
										WHERE 1 
										ORDER BY `ss`.`id` ASC');

	if (!empty($schedule)) {
		$schedule = array_map(function ($item) {
			return [
				'no' => $item['no'],
				'Hari' => $item['hari'],
				'Guru' => $item['guru'],
				'Mapel' => $item['mapel'],
				'Kelas' => $item['class_name'],
				'Jam Mulai' => $item['jam_mulai'],
				'Jam Selesai' => $item['jam_selesai']
			];
		}, $schedule);
	}
	$family = ['dad', 'mom', 'guard'];
	$join_conditions = '';
	foreach ($family as $member) {
		$join_conditions .= " LEFT JOIN `school_parent` `sp_$member` ON `ss`.`parent_id_$member` = `sp_$member`.`id`";
	}
	$select_columns = '';
	foreach ($family as $member) {
		$select_columns .= " `sp_$member`.`name` as `nama_$member`, ";
		$select_columns .= " `sp_$member`.`birthday` as `tanggal_lahir_$member`, ";
		$select_columns .= " `sp_$member`.`nik` as `nik_$member`, ";
		$select_columns .= " `sp_$member`.`phone` as `nomer_telepon_$member`, ";
	}
	$select_columns .= " `sp_guard`.`nokk` as `nomer_kk_guard`, ";
	$select_columns .= " `sp_guard`.`address` as `alamat_guard`";

	$student = $db->getall('SELECT `ss`.`id` as `no`, 
																		`ss`.`name` as `nama_siswa`,
																		`ss`.`birthday` as `tanggal_lahir_siswa`,
																		`ss`.`nis`,
																		`ss`.`nokk` as `nomer_kk`,
																		`ss`.`address` as `alamat`,
																		' . $select_columns . '
																		FROM `school_student` `ss`
																		' . $join_conditions . '
																		WHERE 1 
																		ORDER BY `ss`.`id` ASC');

	if (!empty($student)) {
		$student = array_map(function ($item) {
			return [
				'no' => $item['no'],
				'Nama Siswa' => $item['nama_siswa'],
				'Tanggal Lahir Siswa' => $item['tanggal_lahir_siswa'],
				'NIS' => $item['nis'],
				'Nomer KK' => $item['nomer_kk'],
				'Alamat' => $item['alamat'],
				'Nama Ayah' => $item['nama_dad'],
				'Tanggal Lahir Ayah' => $item['tanggal_lahir_dad'],
				'NIK Ayah' => $item['nik_dad'],
				'Nomer Telepon Ayah' => $item['nomer_telepon_dad'],
				'Nama Ibu' => $item['nama_mom'],
				'Tanggal Lahir Ibu' => $item['tanggal_lahir_mom'],
				'NIK Ibu' => $item['nik_mom'],
				'Nomer Telepon Ibu' => $item['nomer_telepon_mom'],
				'Nama Wali' => $item['nama_guard'],
				'Tanggal Lahir Wali' => $item['tanggal_lahir_guard'],
				'NIK Wali' => $item['nik_guard'],
				'Nomer KK Wali' => $item['nomer_kk_guard'],
				'Nomer Telepon Wali' => $item['nomer_telepon_guard'],
				'Alamat Wali' => $item['alamat_guard']
			];
		}, $student);
	}

	$student_class = $db->getall('SELECT `ssc`.`id` as `no`, 
										`st`.`name` as `student_name`,
										CONCAT_WS(" ",`scc`.grade,`scc`.label,`scc`.major) AS class_name
										FROM `school_student_class` `ssc`
										LEFT JOIN `school_student` `st` ON `ssc`.`student_id` = `st`.`id`
										LEFT JOIN `school_class` `scc` ON `ssc`.`class_id` = `scc`.`id`
										WHERE 1
										ORDER BY `ssc`.`id` ASC');
	if (!empty($student_class)) {
		$student_class = array_map(function ($item) {
			return [
				'no' => $item['no'],
				'Student Name' => $item['student_name'],
				'Class Name' => $item['class_name']
			];
		}, $student_class);
	}

	$student_parent = $db->getall('SELECT `ssp`.`id` as `no`, 
										`st`.`name` as `student_name`,
										`sp`.`name` as `parent_name`
										FROM `school_student_parent` `ssp`
										LEFT JOIN `school_student` `st` ON `ssp`.`student_id` = `st`.`id`
										LEFT JOIN `school_parent` `sp` ON `ssp`.`parent_id` = `sp`.`id`
										WHERE 1
										ORDER BY `ssp`.`id` ASC');

	if (!empty($student_parent)) {
		$student_parent = array_map(function ($item) {
			return [
				'no' => $item['no'],
				'Student Name' => $item['student_name'],
				'Parent Name' => $item['parent_name']
			];
		}, $student_parent);
	}

	$teacher = $db->getall('SELECT `id` AS `no`, 
											`name` AS `teacher_name`,
											`nip`, 
											`phone` as `no_hp`, 
											`position` as `jabatan`, 
											`birthday` as `tanggal_lahir` 
											FROM school_teacher WHERE 1 
											ORDER BY `id` ASC');

	if (!empty($teacher)) {
		$teacher = array_map(function ($item) {
			return [
				'no' => $item['no'],
				'Nama' => $item['teacher_name'],
				'NIP' => $item['nip'],
				'No HP' => $item['no_hp'],
				'Posisi' => $item['jabatan'],
				'Tanggal Lahir' => $item['tanggal_lahir']
			];
		}, $teacher);
	}

	$teacher_subject = $db->getall('SELECT `sts`.`id` AS `no`, 
											`st`.`name` as `teacher_name`,
											`sc`.`name` as `course_name`,
											CONCAT_WS(" ",`scl`.grade,`scl`.label,`scl`.major) AS class_name
											FROM `school_teacher_subject` `sts`  
											LEFT JOIN `school_teacher` `st` ON `sts`.`teacher_id` = `st`.`id`
											LEFT JOIN `school_course` `sc` ON `sts`.`course_id` = `sc`.`id`
											LEFT JOIN `school_class` `scl` ON `sts`.`class_id` = `scl`.`id`
											WHERE 1
											ORDER BY `sts`.`id` ASC');

	if (!empty($teacher_subject)) {
		$teacher_subject = array_map(function ($item) {
			return [
				'no' => $item['no'],
				'Guru' => $item['teacher_name'],
				'Mapel' => $item['course_name'],
				'Kelas' => $item['class_name']
			];
		}, $teacher_subject);
	}

	$data = [];
	foreach ($tables_with_keys as $key => $table) {
		$data[$key] = ${$key};
	}


	if ($_POST['semester'] == 'download') {
		if (!empty($attendance) && !empty($attendance_report) && !empty($class) && !empty($clock) && !empty($course) && !empty($parent) && !empty($schedule) && !empty($student_class) && !empty($student_parent) && !empty($teacher) && !empty($teacher_subject)) {
			$excel = _lib('excel');
			$zip = _class('zip');
			foreach ($data as $key => $value) {
				$path = _ROOT . 'images/cache/uploads/temp/' . $key . '.xlsx';

				$data_excel = ['sheet' => []];
				foreach ($value as $data_entry) {
					$data_excel['sheet'][] = $data_entry;
				}
				array_unshift($data_excel['sheet'], array_keys($data_excel['sheet'][0]));

				$excel->create($data_excel)->save($path);
				$zip->read_file($path);
			}
			$zip->download('backup_semester.zip');
		} else {
			echo msg(
				'Maaf, tidak ada file yg bisa di download',
				'danger'
			);
		}
	}

	foreach ($tables_with_keys as $key => $value) {
		if ($_POST['semester'] == $key) {
			$download_data = [];
			foreach ($data[$key] as $data_entry) {
				$download_data[] = $data_entry;
			}
			_func('download');
			download_excel('backup ' . $key, $download_data, 'backup_' . $key);
		}
	}
}

if (!empty($_POST['delete'])) {
	if ($_POST['delete'] == 'remove') {
		$tables   = ['school_attendance', 'school_attendance_report', 'school_class', 'school_clock', 'school_course', 'school_parent', 'school_schedule', 'school_student', 'school_student_class', 'school_student_parent', 'school_teacher', 'school_teacher_subject'];
		$deleted  = false;

		foreach ($tables as $table) {
			$countQuery = 'SELECT COUNT(*) FROM `' . $table . '`';
			$count      = $db->getOne($countQuery);

			if ($count > 0) {
				$db->Execute('DELETE FROM `' . $table . '`');
				$deleted = true;
			}
		}

		if ($deleted) {
			echo msg('semua data sudah berhasil dihapus', 'success');
		} else {
			echo msg('Tidak ada data yang dihapus.', 'danger');
		}
	}
}


?>
<div class="col-md-6">
	<form action="" method="POST" class="form" role="form">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Semester Baru</h3>
			</div>
			<div class="panel-body">
				<div class="help-block">
					Unduh Data Semester
				</div>
				<div class="help-block">
					<p>Data yang akam di backup dan di hapus meliputi</p>
					<?php
					foreach ($tables_with_keys as $key => $value) {
						echo '<li>';
						$display_key = ucwords(str_replace('_', ' ', $key));
						echo $display_key . ' : ';
						echo $counts[$value];
					?>
						<button type="submit" name="semester" value="<?php echo $key ?>" class="btn" style="border: none; outline: none; background: none; color: blue;">
							<?php echo icon('fa-file-excel-o') ?> Backup Data <?php echo $display_key ?>
						</button>
					<?php
						echo '</li>';
					}
					?>
				</div>
			</div>
			<div class="panel-footer col-md-12" style="display: flex; justify-content: space-between;">
				<button type="submit" name="semester" value="download" class="btn btn-default col-md-6">
					<?php echo icon('fa-file-excel-o') ?> Backup Data
				</button>
				<button type="submit" name="delete" value="remove" class="btn btn-danger col-md-5" onclick="if (confirm('Are you sure you want to delete this data?')) { return true; } else { return false; }">
					<span class="glyphicon glyphicon-trash"></span>
					Hapus Semua Data
				</button>
			</div>
		</div>
	</form>
</div>