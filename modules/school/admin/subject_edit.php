<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');
$form = _lib('pea', 'school_teacher_subject');

$form->initEdit(!empty($_GET['id']) ? 'WHERE id='.$_GET['id'] : '');
$form->edit->setSaveTool(true);

$form->edit->addInput('header', 'header');
$form->edit->input->header->setTitle(!empty($_GET['id']) ? 'Edit Class' : 'Add Class');

$form->edit->addInput('course', 'selecttable');
$form->edit->input->course->setTitle('course');
$form->edit->input->course->setFieldName( 'course_id' );
$form->edit->input->course->setReferenceTable('school_course');
$form->edit->input->course->setReferenceField('name','id');
$form->edit->input->course->setRequire();

$form->edit->addInput('teacher','selecttable');
$form->edit->input->teacher->setFieldName( 'teacher_id' );
$form->edit->input->teacher->setTitle('Add teacher');
$form->edit->input->teacher->addOption('Select Teacher', '');
$form->edit->input->teacher->setReferenceTable('school_teacher');
$form->edit->input->teacher->setReferenceField('name', 'id');
$form->edit->input->teacher->setRequire();

$form->edit->addInput('class', 'selecttable');
$form->edit->input->class->setTitle('class');
$form->edit->input->class->setFieldName( 'class_id' );
$form->edit->input->class->setReferenceTable('school_class');
$form->edit->input->class->setReferenceField('CONCAT_WS(" ",grade,label,major)','id');
$form->edit->input->class->setRequire();

echo $form->edit->getForm();