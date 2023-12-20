<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$form = _lib('pea', 'school_schedule');
$form->initSearch();

$days = school_schedule_day();
$form->search->addInput('day','select');
$form->search->input->day->setTitle('Search by days');
$form->search->input->day->addOption('Select days', '');
$form->search->input->day->addOption($days);

$form->search->addInput('keyword','keyword');
$form->search->input->keyword->addSearchField('keyword,day,clock_start,clock_end');

$add_sql = $form->search->action();
$keyword = $form->search->keyword();
echo $form->search->getForm();

$form->initRoll($add_sql.' ORDER BY id DESC', 'id' );

$form->roll->setSaveTool(true);

$form->roll->addInput( 'id', 'sqlplaintext' );
$form->roll->input->id->setDisplayColumn(true);

$form->roll->addInput( 'day', 'select' );
$form->roll->input->day->setTitle( 'day' );
$form->roll->input->day->addOption($days);
$form->roll->input->day->setPlaintext(true);
$form->roll->input->day->setDisplayColumn(true);

$form->roll->addInput('teacher', 'sqlplaintext');
$form->roll->input->teacher->setTitle('teacher');
$form->roll->input->teacher->setFieldname('teacher_course_id');
$form->roll->input->teacher->setDisplayFunction(function ($value) use($db)
{
	$teacher_id = $db->getone("SELECT teacher_id from school_teacher_course WHERE id=$value");
	$name = $db->getone("SELECT name from school_teacher WHERE id=$teacher_id");
	return $name;
});

$form->roll->addInput('course', 'sqlplaintext');
$form->roll->input->course->setTitle('course');
$form->roll->input->course->setFieldname('teacher_course_id');
$form->roll->input->course->setDisplayFunction(function ($value) use($db)
{
	$course_id = $db->getone("SELECT course_id from school_teacher_course WHERE id=$value");
	$name = $db->getone("SELECT name from school_course WHERE id=$course_id");
	return $name;
});

$form->roll->addInput('class', 'sqlplaintext');
$form->roll->input->class->setTitle('class');
$form->roll->input->class->setFieldname('teacher_course_id');
$form->roll->input->class->setDisplayFunction(function ($value) use($db)
{
	$class_id = $db->getone("SELECT class_id from school_teacher_course WHERE id=$value");
	$name = $db->getone("SELECT CONCAT_WS(' ',`grade`, `major`, `label`) from school_class WHERE id=$class_id");
	return $name;
});


$form->roll->addInput('clock_start', 'sqlplaintext');
$form->roll->input->clock_start->setTitle('clock_start');	
$form->roll->input->clock_start->setDisplayColumn(true);

$form->roll->addInput('clock_end', 'sqlplaintext');
$form->roll->input->clock_end->setTitle('clock_end');
$form->roll->input->clock_end->setDisplayColumn(true);

$form->roll->action();
echo $form->roll->getForm();