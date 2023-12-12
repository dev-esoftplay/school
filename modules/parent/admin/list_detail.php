<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');
$form = _lib('pea',  'school_parent');
$form->initEdit(!empty($_GET['id']) ? 'WHERE id='.$_GET['id'] : '');
$form->edit->setLanguage();

$form->edit->addInput('header','header');
$form->edit->input->header->setTitle(!empty($_GET['id']) ? 'Edit Parent' : 'Add Parent');

$form->edit->addInput('name','text');
$form->edit->input->name->setTitle('name');

$form->edit->addInput('nokk','text');
$form->edit->input->nokk->setTitle('nokk');

$form->edit->addInput('nik','text');
$form->edit->input->nik->setTitle('nik');
$form->edit->action();
echo $form->edit->getForm();