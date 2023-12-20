<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$form = _lib('pea',  'school_student');
$form->initEdit(!empty($_GET['id']) ? 'WHERE id='.$_GET['id'] : '');
$form->edit->setLanguage();

$form->edit->addInput('header','header');
$form->edit->input->header->setTitle(!empty($_GET['id']) ? 'Edit Student' : 'Add Student');

$form->edit->addInput('name','text');
$form->edit->input->name->setTitle('nama');
$form->edit->input->name->setRequire($require='any', $is_mandatory=1);

$form->edit->addInput('nokk','text');
$form->edit->input->nokk->setTitle('nomer kk');
$form->edit->input->nokk->setRequire($require='any', $is_mandatory=1);

$form->edit->addInput('nis','text');
$form->edit->input->nis->setTitle('nis');
$form->edit->input->nis->setRequire($require='any', $is_mandatory=1);
$form->edit->action();

$form->edit->addInput('parent_id_dad', 'selecttable');
$form->edit->input->parent_id_dad->setTitle('ayah');
$form->edit->input->parent_id_dad->setReferenceTable('school_parent');
$form->edit->input->parent_id_dad->setReferenceField('name','user_id');
$form->edit->input->parent_id_dad->setPlaintext(true);

$form->edit->addInput('parent_id_mom', 'selecttable');
$form->edit->input->parent_id_mom->setTitle('ibu');
$form->edit->input->parent_id_mom->setReferenceTable('school_parent');
$form->edit->input->parent_id_mom->setReferenceField('name','user_id');
$form->edit->input->parent_id_mom->setPlaintext(true);

$form->edit->addInput('parent_id_guard', 'selecttable');
$form->edit->input->parent_id_guard->setTitle('wali');
$form->edit->input->parent_id_guard->setReferenceTable('school_parent');
$form->edit->input->parent_id_guard->setReferenceField('name','user_id');
$form->edit->input->parent_id_guard->setPlaintext(true);

echo $form->edit->getForm();