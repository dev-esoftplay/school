<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$form = _lib('pea', 'school_attendance_report');
$form->initSearch();

$form->search->addInput('class_id','selecttable');
$form->search->input->class_id->setTitle('Search by Class');
$form->search->input->class_id->addOption('Select Class', '');
$form->search->input->class_id->setReferenceTable('school_class');
$form->search->input->class_id->setReferenceField('grade', 'id');

$form->search->addInput('course_id','selecttable');
$form->search->input->course_id->setTitle('Search by course');
$form->search->input->course_id->addOption('Select course', '');
$form->search->input->course_id->setReferenceTable('school_course');
$form->search->input->course_id->setReferenceField('name', 'id');

// $subject_id = $db->getone('SELECT `subject_id` FROM `school_schedule` WHERE `id`='.$_GET['schedule_id']);
// $course_id = $db->getone('SELECT `course_id` FROM `school_teacher_subject` WHERE `id`='. $subject_id);
// $course_name = $db->getone('SELECT `name` FROM school_course WHERE `id`='.$course_id);

$form->search->addInput('keyword','keyword');
$form->search->input->keyword->addSearchField('total_present,total_s,total_i,total_a,date_day,date_week,date_month,date_year');

$add_sql = $form->search->action();
$keyword = $form->search->keyword();
echo $form->search->getForm();

$form->initRoll($add_sql.' ORDER BY id DESC', 'id' );

$form->roll->setSaveTool(true);


$form->roll->addInput('id', 'sqlplaintext');
$form->roll->input->id->setTitle('id');
$form->roll->input->id->setDisplayColumn(true);


$form->roll->addInput('class', 'selecttable');
$form->roll->input->class->setTitle('class');
$form->roll->input->class->setFieldName( 'class_id' );
$form->roll->input->class->setReferenceTable('school_class');
$form->roll->input->class->setReferenceField('grade','id');
$form->roll->input->class->setPlaintext(true);
$form->roll->input->class->setDisplayColumn(true);
$form->roll->input->class->textTip='';

$form->roll->addInput('course', 'selecttable');
$form->roll->input->course->setTitle('course');
$form->roll->input->course->setFieldName( 'course_id' );
$form->roll->input->course->setReferenceTable('school_course');
$form->roll->input->course->setReferenceField('name','id');
$form->roll->input->course->setPlaintext(true);
$form->roll->input->course->setDisplayColumn(true);
$form->roll->input->course->textTip='';

// $form->roll->addInput('course', 'sqlplaintext');
// $form->roll->input->course->setTitle('course');
// $form->roll->input->course->setFieldname('schedule_id');
// $form->roll->input->course->setDisplayFunction(function ($value) use($db)
// {
// 	$subject_id = $db->getone("SELECT subject_id from school_schedule Where id=$value");
// 	$course_id = $db->getone("SELECT course_id from school_teacher_subject WHERE id=$subject_id");
// 	$name = $db->getone("SELECT name from school_course WHERE id=$course_id");
// 	return $name;
// });


$form->roll->addInput('total_present', 'sqlplaintext');
$form->roll->input->total_present->setTitle('Total Present');
$form->roll->input->total_present->setDisplayColumn(true);

$form->roll->addInput('total_s', 'sqlplaintext');
$form->roll->input->total_s->setTitle('Total Sick');
$form->roll->input->total_s->setDisplayColumn(true);

$form->roll->addInput('total_i', 'sqlplaintext');
$form->roll->input->total_i->setTitle('Total Permission');
$form->roll->input->total_i->setDisplayColumn(true);

$form->roll->addInput('total_a', 'sqlplaintext');
$form->roll->input->total_a->setTitle('Total Alpha');
$form->roll->input->total_a->setDisplayColumn(true);

$form->roll->addInput('date_day', 'sqlplaintext');
$form->roll->input->date_day->setTitle('Day');
$form->roll->input->date_day->setDisplayColumn(false);

$form->roll->addInput('date_week', 'sqlplaintext');
$form->roll->input->date_week->setTitle('Week');
$form->roll->input->date_week->setDisplayColumn(false);

$form->roll->addInput('date_month', 'sqlplaintext');
$form->roll->input->date_month->setTitle('Month');
$form->roll->input->date_month->setDisplayColumn(false);

$form->roll->addInput('date_year', 'sqlplaintext');
$form->roll->input->date_year->setTitle('Year');
$form->roll->input->date_year->setDisplayColumn(false);




$form->roll->action();
echo $form->roll->getForm();