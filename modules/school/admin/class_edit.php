<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');


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

