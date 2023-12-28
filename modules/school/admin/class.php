<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$form = _lib('pea', 'school_class');
$form->initSearch();

$form->search->addInput('keyword','keyword');
$form->search->input->keyword->addSearchField('grade,label,major');
$add_sql = $form->search->action();
$keyword = $form->search->keyword();

echo $form->search->getForm();

$form = _lib('pea', 'school_class');
$form->initroll("WHERE 1 ORDER BY grade ASC");
$form->roll->setSaveTool(false);

$form->roll->addInput( 'id', 'sqlplaintext' );
$form->roll->input->id->setFieldName( 'id AS class_id' );
$form->roll->input->id->setDisplayColumn(true);

$form->roll->addInput( 'classes', 'sqllinks' );
$form->roll->input->classes->setFieldName( 'CONCAT_WS(" ",grade,label,major) AS classes' );
$form->roll->input->classes->setLinks($Bbc->mod['circuit'].'.class_edit');

$form->roll->addInput('teacher_id', 'selecttable');
$form->roll->input->teacher_id->setTitle('teacher');
$form->roll->input->teacher_id->setFieldName( 'teacher_id' );
$form->roll->input->teacher_id->setReferenceTable('school_teacher');
$form->roll->input->teacher_id->setReferenceField('name','id');
$form->roll->input->teacher_id->setPlaintext(true);
$form->roll->input->teacher_id->setDisplayColumn(true);
$form->roll->input->teacher_id->textTip='';

echo $form->roll->getForm();

include 'class_add.php';
