<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$form = _lib('pea', 'school_parent');
$form->initSearch();

/*==========================================
 * START LIST
/*=========================================*/
$form->search->addInput('publish','select');
$form->search->input->publish->addOption('All Status', '');
$form->search->input->publish->addOption('Published', '1');
$form->search->input->publish->addOption('Not Published', '0');
$tabs = array('parent' => '', 'Add parent' => '');

$form->search->addInput('keyword','keyword');
$form->search->input->keyword->addSearchField('name, nokk, nik', false); //true = fulltext in database field

$add_sql = $form->search->action();
$keyword = $form->search->keyword();
echo $form->search->getForm();

$form->initRoll("$add_sql ORDER BY `id` ASC", 'id'); 

$form->roll->addInput('id', 'sqlplaintext');
$form->roll->input->id->setTitle('id');

$form->roll->addInput('name', 'sqllinks');
$form->roll->input->name->setTitle('name');
$form->roll->input->name->setLinks($Bbc->mod['circuit'].'.parent_edit');

$form->roll->addInput('user_id', 'sqlplaintext');
$form->roll->input->user_id->setTitle('email');
$form->roll->input->user_id->setDisplayFunction(
  function ($value) use($db)
  {
    $email = $db->getOne('SELECT `email` FROM `bbc_account` WHERE `user_id`='. $value);
    return $email;
  }
);

$form->roll->addInput('nik', 'text');
$form->roll->input->nik->setTitle('nik');
$form->roll->input->nik->setPlainText(true);

$form->roll->action();
$tabs['parent'] =  $form->roll->getForm();

/*==========================================
 * START ADD PARENT
/*=========================================*/

$form = _lib('pea', 'school_parent');
$form->initAdd();

$form->add->addInput('name','text');
$form->add->input->name->setTitle('name');
$form->add->input->name->setRequire($require='any', $is_mandatory=1);

$form->add->addInput('phone','text');
$form->add->input->phone->setTitle('phone');
$form->add->input->phone->setRequire($require='any', $is_mandatory=1);

$form->add->addInput('nik','text');
$form->add->input->nik->setTitle('nik');
$form->add->input->nik->setRequire($require='any', $is_mandatory=1);

$form->add->addInput('nokk','text');
$form->add->input->nokk->setTitle('nokk');
$form->add->input->nokk->setRequire($require='any', $is_mandatory=1);

$form->add->action();
$tabs['Add parent'] = $form->add->getForm();
echo tabs($tabs, 1, 'tabs_links');
