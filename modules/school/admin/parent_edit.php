<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$form = _lib('pea',  'school_parent');
$form->initEdit(!empty($_GET['id']) ? 'WHERE id='.$_GET['id'] : '');
$form->edit->setLanguage();


$form->edit->addInput('header','header');
$form->edit->input->header->setTitle(!empty($_GET['id']) ? 'Edit Parent' : 'Add Parent');

$form->edit->addInput('name','text');
$form->edit->input->name->setTitle('name');
$form->edit->input->name->setRequire($require='any', $is_mandatory=1);

$form->edit->addInput('phone','text');
$form->edit->input->phone->setTitle('phone');
$form->edit->input->phone->setRequire($require='any', $is_mandatory=1);
$form->edit->action();

$form->edit->addInput('nokk','text');
$form->edit->input->nokk->setTitle('nokk');
$form->edit->input->nokk->setRequire($require='any', $is_mandatory=1);

$form->edit->addInput('nik','text');
$form->edit->input->nik->setTitle('nik');
$form->edit->input->nik->setRequire($require='any', $is_mandatory=1);
$form->edit->action();

$form->edit->addInput('user_id', 'sqlplaintext');
$form->edit->input->user_id->setTitle('email');
$form->edit->input->user_id->setDisplayFunction(
  function ($value) use($db)
  {
    if(!empty($value))
    {
      $email = $db->getOne('SELECT `email` FROM `bbc_account` WHERE `user_id`='. $value);
      return $email;
    }
  }
);

$form->edit->addInput('id', 'sqlplaintext');
$form->edit->input->id->setTitle('child');
$form->edit->input->id->setDisplayFunction(
  function ($value) use($db)
  {
    $student_id = $db->getCol('SELECT `student_id` FROM `school_student_parent` WHERE `parent_id` ='. $value); 
    $name       = $db->getCol('SELECT `name` FROM `school_student` WHERE `id` IN ('.implode(',', $student_id).');');
    return implode('  &  ',$name);
  }
);

echo $form->edit->getForm();


