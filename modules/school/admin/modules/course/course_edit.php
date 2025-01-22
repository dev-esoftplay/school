<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');
$form = _lib('pea', 'school_course');

$form->initEdit(!empty($_GET['id']) ? 'WHERE id=' . $_GET['id'] : '');
$form->edit->setSaveTool(true);

$form->edit->addInput('header', 'header');
$form->edit->input->header->setTitle(!empty($_GET['id']) ? 'Edit Course' : 'Add Course');

$form->edit->addInput('course', 'text');
$form->edit->input->course->setTitle('course');
$form->edit->input->course->setFieldName('name');
$form->edit->input->course->setRequire();

echo $form->edit->getForm();
