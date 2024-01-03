<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$form = _lib('pea', 'school_teacher_subject');
$form->initSearch();

/*$form->search->addInput('teacher_id', 'selecttable');
$form->search->input->teacher_id->setTitle('Guru');
$form->search->input->teacher_id->addOption('Select Guru', '');
$form->search->input->teacher_id->setReferenceTable('school_teacher');
$form->search->input->teacher_id->setReferenceField( 'name', 'id' );

$form->search->addInput('class_id','selecttable');
$form->search->input->class_id->setTitle('Search by Class');
$form->search->input->class_id->addOption('Select Class', '');
$form->search->input->class_id->setReferenceTable('school_class');
$form->search->input->class_id->setReferenceField('grade', 'id');

$form->search->addInput('course_id','selecttable');
$form->search->input->course_id->setTitle('Search by course');
$form->search->input->course_id->addOption('Select course', '');
$form->search->input->course_id->setReferenceTable('school_course');
$form->search->input->course_id->setReferenceField('name', 'id');*/

$form->search->addInput('keyword','keyword');
$form->search->input->keyword->addSearchField('keyword,day,clock_start,clock_end');

$add_sql = $form->search->action();
$keyword = $form->search->keyword();
echo $form->search->getForm();

$form->initRoll($add_sql.' ORDER BY id DESC', 'id' );

$form->roll->setSaveTool(true);

$form->roll->addInput('id', 'sqlplaintext');
$form->roll->input->id->setTitle('id');
$form->roll->input->id->setDisplayColumn(true);

$form->roll->addInput('course_id', 'selecttable');
$form->roll->input->course_id->setTitle('course');
$form->roll->input->course_id->setFieldName( 'course_id' );
$form->roll->input->course_id->setReferenceTable('school_course');
$form->roll->input->course_id->setReferenceField('name','id');
$form->roll->input->course_id->setPlaintext(true);
$form->roll->input->course_id->setDisplayColumn(true);
$form->roll->input->course_id->textTip='';

$form->roll->addInput('teacher_id', 'selecttable');
$form->roll->input->teacher_id->setTitle('teacher');
$form->roll->input->teacher_id->setFieldName( 'teacher_id' );
$form->roll->input->teacher_id->setReferenceTable('school_teacher');
$form->roll->input->teacher_id->setReferenceField('name','id');
$form->roll->input->teacher_id->setPlaintext(true);
$form->roll->input->teacher_id->setDisplayColumn(true);
$form->roll->input->teacher_id->textTip='';

$form->roll->addInput('class_id', 'selecttable');
$form->roll->input->class_id->setTitle('class');
$form->roll->input->class_id->setFieldName( 'class_id' );
$form->roll->input->class_id->setReferenceTable('school_class');
$form->roll->input->class_id->setReferenceField( 'CONCAT_WS(" ",grade,label,major) AS classes','id');
$form->roll->input->class_id->setPlaintext(true);
$form->roll->input->class_id->setDisplayColumn(true);
$form->roll->input->class_id->textTip='';

$form->roll->action();
echo $form->roll->getForm();

include 'course_add.php';
