<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$position = array('Kepala Sekolah', 'Wakil Kepala Sekolah', 'Guru BK', 'Staff', 'Tukang Kebun');

$form = _lib('pea',  'school_teacher');
$form->initEdit(!empty($_GET['id']) ? 'WHERE id='.$_GET['id'] : '');

$form->edit->addInput('header','header');
$form->edit->input->header->setTitle(!empty($_GET['id']) ? 'Edit Data' : 'Add Data');

$form->edit->addInput('name','text');
$form->edit->input->name->setTitle('name');

$form->edit->addInput('nip','text');
$form->edit->input->nip->setTitle('nip');

$form->edit->addInput('phone','text');
$form->edit->input->phone->setTitle('phone');

$form->edit->addInput('position','select');
$form->edit->input->position->addOption('Select Position', '');
$form->edit->input->position->addOption($position);

$form->edit->action();
echo $form->edit->getForm();