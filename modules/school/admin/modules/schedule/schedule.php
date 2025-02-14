<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$currentSemester = $db->getOne("SELECT `semester` FROM `school`");
//TODO: buat chrone job buat ganti semester setelah jadwal raport 

// $show_list = true;
if (!empty($_POST['template'])) {
	if ($_POST['template'] == 'download') {
		$r = array(
			array(
				'No'      => '',
				'Course'  => '',
				'Teacher' => '',
				'Class'   => '',
				'Day'     => '',
				'Clock'   => '',
			)
		);
		if (!empty($r)) {
			_func('download');
			download_excel('Template ' . $Bbc->mod['task'] . ' ' . date('Y-m-d') . ' ' . rand(0, 999), $r);
		} else {
			echo msg('Maaf, tidak ada file yg bisa di download', 'danger');
		}
	}
}

// if ($show_list)
// {
$form = _lib('pea', 'school_schedule');
$form->initSearch();

?>

<p style="margin: 0px 0px 20px 10px ">Semester Sekarang: <?php echo $currentSemester; ?></p>


<a href="<?php echo site_url('school/schedule_add') ?>">
	<button type="button" class="btn btn-info" style="margin: 0px 0px 0px 10px ">Tambahkan Jadwal</button>
</a>

<div style="margin: 0px 10px 0px 10px ">

	<?php

	$days = school_schedule_day();

	$form->search->addInput('keyword', 'keyword');
	$form->search->input->keyword->addSearchField('day,clock_start,clock_end');

	$add_sql = $form->search->action();
	$keyword = $form->search->keyword();
	echo $form->search->getForm();

	$form->initRoll($add_sql . ' ORDER BY day ASC', 'id');

	$form->roll->setSaveTool(false);

	$form->roll->addInput('id', 'sqlplaintext');
	$form->roll->input->id->setDisplayColumn(true);

	$form->roll->addInput('id', 'sqllinks');
	$form->roll->input->id->setFieldName('id AS edit');
	$form->roll->input->id->setLinks($Bbc->mod['circuit'] . '.schedule_edit');

	$form->roll->addInput('day', 'select');
	$form->roll->input->day->setTitle('day');
	$form->roll->input->day->addOption($days);
	$form->roll->input->day->setPlaintext(true);
	$form->roll->input->day->setDisplayColumn(true);


	$form->roll->addInput('course', 'sqlplaintext');
	$form->roll->input->course->setTitle('course');
	$form->roll->input->course->setFieldname('subject_id');
	$form->roll->input->course->setDisplayFunction(function ($value) use ($db) {
		$course_id = $db->getone("SELECT course_id from school_teacher_subject WHERE id=$value");
		$name = $db->getone("SELECT name from school_course WHERE id=$course_id");
		return $name;
	});

	$form->roll->addInput('teacher', 'sqlplaintext');
	$form->roll->input->teacher->setTitle('teacher');
	$form->roll->input->teacher->setFieldname('subject_id');
	$form->roll->input->teacher->setDisplayFunction(function ($value) use ($db) {
		$teacher_id = $db->getone("SELECT teacher_id from school_teacher_subject WHERE id=$value");
		$name = $db->getone("SELECT name from school_teacher WHERE id=$teacher_id");
		return $name;
	});

	$form->roll->addInput('class', 'sqlplaintext');
	$form->roll->input->class->setTitle('class');
	$form->roll->input->class->setFieldname('subject_id');
	$form->roll->input->class->setDisplayFunction(function ($value) use ($db) {
		$class_id = $db->getone("SELECT class_id from school_teacher_subject WHERE id=$value");
		$name = $db->getone("SELECT CONCAT_WS(' ',`grade`, `major`, `label`) from school_class WHERE id=$class_id");
		return $name;
	});


	$form->roll->addInput('clock_start', 'sqlplaintext');
	$form->roll->input->clock_start->setTitle('clock start');
	$form->roll->input->clock_start->setDisplayColumn(true);

	$form->roll->addInput('clock_end', 'sqlplaintext');
	$form->roll->input->clock_end->setTitle('clock end');
	$form->roll->input->clock_end->setDisplayColumn(true);

	$form->roll->addReport('excel');
	$form->roll->action();

	echo $form->roll->getForm();
	?>

</div>