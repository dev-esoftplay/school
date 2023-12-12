<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$form = _lib('pea', 'school_parent');
$form->initSearch();

$form->search->addInput('publish','select');
$form->search->input->publish->addOption('All Status', '');
$form->search->input->publish->addOption('Published', '1');
$form->search->input->publish->addOption('Not Published', '0');

$form->search->addInput('keyword','keyword');
$form->search->input->keyword->addSearchField('name, nokk, nik', false); //true = fulltext in database field

$add_sql = $form->search->action();
$keyword = $form->search->keyword();
echo $form->search->getForm();

$form->initRoll("$add_sql ORDER BY `id` DESC", 'id');
#$form->roll->setSaveTool(false);

$form->roll->addInput('name', 'sqllinks');
$form->roll->input->name->setTitle('name');
$form->roll->input->name->setLinks($Bbc->mod['circuit'].'.list_detail');

$form->roll->addInput('nokk', 'text');
$form->roll->input->nokk->setTitle('nokk');
$form->roll->input->nokk->setPlainText(true);

$form->roll->addInput('nik', 'text');
$form->roll->input->nik->setTitle('nik');
$form->roll->input->nik->setPlainText(true);


$form->roll->action();

echo $form->roll->getForm();