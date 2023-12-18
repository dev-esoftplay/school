<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$form = _lib('pea', 'school_student');
$form->initSearch();

$form->search->addInput('publish','select');
$form->search->input->publish->addOption('All Status', '');
$form->search->input->publish->addOption('Published', '1');
$form->search->input->publish->addOption('Not Published', '0');

$form->search->addInput('keyword','keyword');
$form->search->input->keyword->addSearchField('name, nokk, nis', false); //true = fulltext in database field

$add_sql = $form->search->action();
$keyword = $form->search->keyword();
echo $form->search->getForm();

$tabs = array('student' => '', 'Add student' => '');

$form->initRoll("$add_sql ORDER BY `id` DESC", 'id');

$form->roll->addInput('id', 'sqlplaintext');
$form->roll->input->id->setTitle('id');

$form->roll->addInput('name', 'sqllinks');
$form->roll->input->name->setTitle('name');
$form->roll->input->name->setLinks($Bbc->mod['circuit'].'.student_edit');
$form->roll->addInput('user_id', 'sqlplaintext');

$form->roll->input->user_id->setTitle('email');
$form->roll->input->user_id->setDisplayFunction( function ($value) use($db)
  {
    $email = $db->getOne('SELECT `email` FROM `bbc_account` WHERE user_id='. $value);
    return $email;
  }
);
$form->roll->addInput('nis', 'text');
$form->roll->input->nis->setTitle('nis');   
$form->roll->input->nis->setPlainText(true);

$form->roll->action();
$tabs['student'] = $form->roll->getForm();

$form = _lib('pea', 'school_student');
$form->initAdd();

$form->add->addInput('header','header');
$form->add->input->header->setTitle('Add Data');

$form->add->addInput('name','text');
$form->add->input->name->setTitle('name');
$form->add->input->name->setRequire($require='any', $is_mandatory=1);

$form->add->addInput('nis','text');
$form->add->input->nis->setTitle('nis');
$form->add->input->nis->setRequire($require='any', $is_mandatory=1);

$form->add->addInput('nokk','text');
$form->add->input->nokk->setTitle('nokk');
$form->add->input->nokk->setRequire($require='any', $is_mandatory=1);

$form->add->action();
$tabs['Add student'] = $form->add->getForm();
echo tabs($tabs, 1, 'tabs_links');