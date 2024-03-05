<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');
$class_id = $db->getCol('SELECT `id` FROM `school_teacher_subject` WHERE `class_id`='.$_GET['id']);

$form = _lib('pea', 'school_student_class');

$form->initroll(!empty($_GET['id']) ? 'WHERE class_id='.$_GET['id']. ' ORDER BY id ASC' : '');

$form->roll->setSaveTool(false);

$form->roll->addInput( 'id', 'sqlplaintext' );
$form->roll->input->id->setFieldName( 'id AS page_id' );

$form->roll->addInput('number', 'sqllinks');
$form->roll->input->number->setTitle('number');
$form->roll->input->number->setLinks($Bbc->mod['circuit'].'.'.$Bbc->mod['task'].'_edit');

$form->roll->addInput('name', 'sqlplaintext');
$form->roll->input->name->setTitle('name');
$form->roll->input->name->setFieldName( 'student_id' );
$form->roll->input->name->setPlaintext(true);
$form->roll->input->name->setDisplayFunction(function ($value) use($db)
{
	$student_id = $db->getone("SELECT student_id from school_student_class WHERE id=$value");
	$name = $db->getone("SELECT name from school_student WHERE id=$student_id");
	return $name;
});

$form->roll->addInput('nis', 'sqlplaintext');
$form->roll->input->nis->setTitle('nis');
$form->roll->input->nis->setFieldName( 'student_id' );
$form->roll->input->nis->setPlaintext(true);
$form->roll->input->nis->setDisplayFunction(function ($value) use($db)
{
	$student_id = $db->getone("SELECT student_id from school_student_class WHERE id=$value");
	$nis = $db->getone("SELECT nis from school_student WHERE id=$student_id");
	return $nis;
});

$form->roll->addInput('nokk', 'sqlplaintext');
$form->roll->input->nokk->setTitle('nokk');
$form->roll->input->nokk->setFieldName( 'student_id' );
$form->roll->input->nokk->setPlaintext(true);
$form->roll->input->nokk->setDisplayFunction(function ($value) use($db)
{
	$student_id = $db->getone("SELECT student_id from school_student_class WHERE id=$value");
	$nokk = $db->getone("SELECT nokk from school_student WHERE id=$student_id");
	return $nokk;
});

echo $form->roll->getForm();
