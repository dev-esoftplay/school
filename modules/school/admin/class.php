<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$form = _lib('pea', 'school_class');
$form->initroll("WHERE 1 ORDER BY grade ASC");
$form->roll->setSaveTool(false);

$form->roll->addInput( 'id', 'sqlplaintext' );
$form->roll->input->id->setFieldName( 'id AS class_id' );
$form->roll->input->id->setDisplayColumn(true);

$form->roll->addInput( 'class_name', 'sqllinks' );
$form->roll->input->class_name->setFieldName( 'CONCAT_WS(" ",grade,label,major) AS class_name' );
$form->roll->input->class_name->setLinks($Bbc->mod['circuit'].'.class_edit');

$form->roll->addInput('grade', 'sqlplaintext');
$form->roll->input->grade->setTitle('Grade');
$form->roll->input->grade->setDisplayColumn(true);


$form->roll->addInput('label', 'sqlplaintext');
$form->roll->input->label->setTitle('label');
$form->roll->input->label->setDisplayColumn(true);


$form->roll->addInput('major', 'sqlplaintext');
$form->roll->input->major->setTitle('major');
$form->roll->input->major->setDisplayColumn(true);


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
