<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');
$class_id = $db->getCol('SELECT `id` FROM `school_teacher_subject` WHERE `class_id`='.$_GET['id']);

$form = _lib('pea', 'school_class');
$form->initSearch();

$form->search->addInput('keyword','keyword');
$form->search->input->keyword->addSearchField('grade,label,major');
$add_sql = $form->search->action();
$keyword = $form->search->keyword();
echo $form->search->getForm();

$tabs = array('Edit Class' => '', 'Student' => '', 'Schedule' => '');

$form = _lib('pea', 'school_class');

$form->initEdit(!empty($_GET['id']) ? 'WHERE id='.$_GET['id'] : '');

// $form->edit->setSaveTool(true);

$form->edit->addInput('header', 'header');
$form->edit->input->header->setTitle(!empty($_GET['id']) ? 'Edit Class' : 'Add Class');

// $form->edit->addInput( 'id', 'text' );
// $form->edit->input->id->setFieldName( 'id AS class_id' );

$form->edit->addInput( 'grade', 'text' );
$form->edit->input->grade->setFieldName( 'grade' );

$form->edit->addInput( 'label', 'text' );
$form->edit->input->label->setFieldName( 'label' );

$form->edit->addInput( 'major', 'text' );
$form->edit->input->major->setFieldName( 'major' );

$form->edit->addInput('teacher', 'selecttable');
$form->edit->input->teacher->setTitle('teacher');
$form->edit->input->teacher->setFieldName( 'teacher_id' );
$form->edit->input->teacher->setReferenceTable('school_teacher');
$form->edit->input->teacher->setReferenceField('name','id');
$form->edit->input->teacher->textTip='';

$form->edit->action();

$tabs['Edit Class'] = $form->edit->getForm();

/* 	INI TABEL Student in class */

// $class_id   = @intval($_GET['class_id']);
$form = _lib('pea', 'school_student_class');

$form->initroll(!empty($_GET['id']) ? 'WHERE class_id='.$_GET['id']. ' ORDER BY id ASC' : '');

$form->roll->setSaveTool(true);

$form->roll->addInput( 'id', 'sqlplaintext' );
$form->roll->input->id->setFieldName( 'id AS page_id' );

$form->roll->addInput('number', 'sqllinks');
$form->roll->input->number->setTitle('number');
$form->roll->input->number->setLinks($Bbc->mod['circuit'].'.'.$Bbc->mod['task'].'_edit');

$form->roll->addInput('name', 'sqlplaintext');
$form->roll->input->name->setTitle('name');
$form->roll->input->name->setFieldName( 'student_id' );
// $form->roll->input->name->setReferenceTable('school_student');
// $form->roll->input->name->setReferenceField('name','id');
$form->roll->input->name->setDisplayFunction(function ($value) use($db)
{
	$student_id = $db->getone("SELECT student_id from school_student_class WHERE id=$value");
	$name = $db->getone("SELECT name from school_student WHERE id=$student_id");
	return $name;
});
$form->roll->input->name->setPlaintext(true);

$form->roll->addInput('nis', 'sqlplaintext');
$form->roll->input->nis->setTitle('nis');
$form->roll->input->nis->setFieldName( 'student_id' );
$form->roll->input->nis->setDisplayFunction(function ($value) use($db)
{
	$student_id = $db->getone("SELECT student_id from school_student_class WHERE id=$value");
	$nis = $db->getone("SELECT nis from school_student WHERE id=$student_id");
	return $nis;
});
$form->roll->input->nis->setPlaintext(true);

$form->roll->addInput('nokk', 'sqlplaintext');
$form->roll->input->nokk->setTitle('nokk');
$form->roll->input->nokk->setFieldName( 'student_id' );
$form->roll->input->nokk->setDisplayFunction(function ($value) use($db)
{
	$student_id = $db->getone("SELECT student_id from school_student_class WHERE id=$value");
	$nokk = $db->getone("SELECT nokk from school_student WHERE id=$student_id");
	return $nokk;
});
$form->roll->input->nokk->setPlaintext(true);


$tabs['Student'] =  $form->roll->getForm();


/* 	Ini Form Schedule */

if (!empty($class_id)) {
	// code...
	$form = _lib('pea', 'school_schedule');

	$days = school_schedule_day();
	$form->initroll(!empty($_GET['id']) ? 'WHERE  `subject_id` IN ('.implode(',', $class_id).') ORDER BY `id` ASC' : '');
	$form->roll->setSaveTool(true);

	$form->roll->addInput( 'id', 'sqlplaintext' );
	$form->roll->input->id->setFieldName( 'id AS page_id' );


	$form->roll->addInput('course', 'sqlplaintext');
	$form->roll->input->course->setTitle('course');
	$form->roll->input->course->setFieldname('subject_id AS course');
	$form->roll->input->course->setDisplayFunction(function ($value) use($db)
	{
		$course_id = $db->getone("SELECT course_id from school_teacher_subject WHERE id=$value");
		$name = $db->getone("SELECT name from school_course WHERE id=$course_id");
		return $name;
	});
	$form->roll->addInput( 'day', 'select' );
	$form->roll->input->day->setTitle( 'day' );
	$form->roll->input->day->addOption($days);
	$form->roll->input->day->setPlaintext(true);
	$form->roll->input->day->setDisplayColumn(true);

	$form->roll->addInput('teacher', 'sqlplaintext');
	$form->roll->input->teacher->setTitle('teacher');
	$form->roll->input->teacher->setFieldname('subject_id AS course');
	$form->roll->input->teacher->setDisplayFunction(function ($value) use($db)
	{
		$teacher_id = $db->getone("SELECT teacher_id from school_teacher_subject WHERE id=$value");
		$name = $db->getone("SELECT name from school_teacher WHERE id=$teacher_id");
		return $name;
	});

	// $form->roll->addInput('class', 'sqlplaintext');
	// $form->roll->input->class->setTitle('class');
	// $form->roll->input->class->setFieldname('subject_id AS class');
	// $form->roll->input->class->setDisplayFunction(function ($value) use($db)
	// {
	// 	$class_id = $db->getone("SELECT class_id from school_teacher_subject WHERE id=$value");
	// 	$name = $db->getone("SELECT CONCAT_WS(' ',`grade`, `major`, `label`) from school_class WHERE id=$class_id");
	// 	return $name;
	// });

	$form->roll->addInput('clock_start', 'sqlplaintext');
	$form->roll->input->clock_start->setTitle('clock_start');	
	$form->roll->input->clock_start->setDisplayColumn(true);

	$form->roll->addInput('clock_end', 'sqlplaintext');
	$form->roll->input->clock_end->setTitle('clock_end');
	$form->roll->input->clock_end->setDisplayColumn(true);

}
$tabs['Schedule'] =  $form->roll->getForm();

echo tabs($tabs, 1, 'tabs_links');