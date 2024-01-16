<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');
$class_id = $db->getCol('SELECT `id` FROM `school_teacher_subject` WHERE `class_id`='.$_GET['id']);

$tabs = array('Edit Class' => '', 'Schedule' => '');

$form = _lib('pea', 'school_class');

$form->initEdit(!empty($_GET['id']) ? 'WHERE id='.$_GET['id'] : '');

$form->edit->addInput('header', 'header');
$form->edit->input->header->setTitle(!empty($_GET['id']) ? 'Edit Class' : 'Add Class');

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


/* 	Ini Form Schedule */

if (!empty($class_id)) {
	$form = _lib('pea', 'school_schedule');

	$days = school_schedule_day();
	$form->initroll(!empty($_GET['id']) ? 'WHERE  `subject_id` IN ('.implode(',', $class_id).') ORDER BY `id` ASC' : '');
	$form->roll->setSaveTool(false);

	$form->roll->addInput('header', 'header');
	$form->roll->input->header->setTitle(!empty($_GET['id']) ? 'Schedule Class' : ' ');

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

	$form->roll->addInput('subject_teacher', 'sqlplaintext');
	$form->roll->input->subject_teacher->setTitle('subject_teacher');
	$form->roll->input->subject_teacher->setFieldname('subject_id AS course');
	$form->roll->input->subject_teacher->setDisplayFunction(function ($value) use($db)
	{
		$teacher_id = $db->getone("SELECT teacher_id from school_teacher_subject WHERE id=$value");
		$name = $db->getone("SELECT name from school_teacher WHERE id=$teacher_id");
		return $name;
	});

	$form->roll->addInput('class', 'sqlplaintext');
	$form->roll->input->class->setTitle('class');
	$form->roll->input->class->setFieldname('subject_id AS class');
	$form->roll->input->class->setDisplayFunction(function ($value) use($db)
	{
		$class_id = $db->getone("SELECT class_id from school_teacher_subject WHERE id=$value");
		$name = $db->getone("SELECT CONCAT_WS(' ',`grade`, `major`, `label`) from school_class WHERE id=$class_id");
		return $name;
	});

	$form->roll->addInput('clock_start', 'sqlplaintext');
	$form->roll->input->clock_start->setTitle('clock_start');	
	$form->roll->input->clock_start->setDisplayColumn(true);

	$form->roll->addInput('clock_end', 'sqlplaintext');
	$form->roll->input->clock_end->setTitle('clock_end');
	$form->roll->input->clock_end->setDisplayColumn(true);

	$tabs['Schedule'] =  $form->roll->getForm();
}

include 'class_student.php';

echo tabs($tabs, 1, 'tabs_links');