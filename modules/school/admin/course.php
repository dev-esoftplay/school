<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$form = _lib('pea', 'school_teacher_course');
$form->initSearch();

$form->search->addInput('teacher_id', 'selecttable');
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
$form->search->input->course_id->setReferenceField('name', 'id');

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


$form->roll->addInput('teacher', 'selecttable');
$form->roll->input->teacher->setTitle('teacher');
$form->roll->input->teacher->setFieldName( 'teacher_id' );
$form->roll->input->teacher->setReferenceTable('school_teacher');
$form->roll->input->teacher->setReferenceField('name','id');
$form->roll->input->teacher->setPlaintext(true);
$form->roll->input->teacher->setDisplayColumn(true);
$form->roll->input->teacher->textTip='';

$form->roll->addInput('class', 'selecttable');
$form->roll->input->class->setTitle('class');
$form->roll->input->class->setFieldName( 'class_id' );
$form->roll->input->class->setReferenceTable('school_class');
$form->roll->input->class->setReferenceField('grade','id');
$form->roll->input->class->setPlaintext(true);
$form->roll->input->class->setDisplayColumn(true);
$form->roll->input->class->textTip='';

$form->roll->addInput('course', 'selecttable');
$form->roll->input->course->setTitle('course');
$form->roll->input->course->setFieldName( 'course_id' );
$form->roll->input->course->setReferenceTable('school_course');
$form->roll->input->course->setReferenceField('name','id');
$form->roll->input->course->setPlaintext(true);
$form->roll->input->course->setDisplayColumn(true);
$form->roll->input->course->textTip='';

$form->roll->action();
echo $form->roll->getForm();