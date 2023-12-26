<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

/*==========================================
* START LIST
/*=========================================*/

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

$form->initRoll("$add_sql ORDER BY `id` ASC", 'id'); 
$form->roll->setSaveTool(false);

$form->roll->addInput('id', 'sqlplaintext');
$form->roll->input->id->setTitle('id');
$form->roll->input->id->setDisplayColumn(true); 

$form->roll->addInput('name', 'sqllinks');
$form->roll->input->name->setTitle('nama');
$form->roll->input->name->setLinks($Bbc->mod['circuit'].'.parent_edit');

$form->roll->addInput('nik', 'text');
$form->roll->input->nik->setTitle('nik');
$form->roll->input->nik->setPlainText(true);
$form->roll->input->nik->setDisplayColumn(true); 

$form->roll->action();
echo  $form->roll->getForm();

