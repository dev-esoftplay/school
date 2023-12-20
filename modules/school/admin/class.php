<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$form = _lib('pea', 'school_class');
$form->initSearch();

$form->search->addInput('keyword','keyword');
$form->search->input->keyword->addSearchField('grade,label,major');
$add_sql = $form->search->action();
$keyword = $form->search->keyword();
echo $form->search->getForm();

$tabs = array('List Class' => '', 'New Class' => '');

$form = _lib('pea', 'school_class');
$form->initroll("WHERE 1 ORDER BY grade ASC");
$form->roll->setSaveTool(false);

$form->roll->addInput( 'id', 'sqlplaintext' );
$form->roll->input->id->setFieldName( 'id AS class_id' );
$form->roll->input->id->setDisplayColumn(true);

$form->roll->addInput( 'classes', 'sqllinks' );
$form->roll->input->classes->setFieldName( 'CONCAT_WS(" ",grade,label,major) AS classes' );
$form->roll->input->classes->setLinks($Bbc->mod['circuit'].'.class_edit');

$form->roll->addInput('teacher', 'selecttable');
$form->roll->input->teacher->setTitle('teacher');
$form->roll->input->teacher->setFieldName( 'teacher_id' );
$form->roll->input->teacher->setReferenceTable('school_teacher');
$form->roll->input->teacher->setReferenceField('name','id');
$form->roll->input->teacher->setPlaintext(true);
$form->roll->input->teacher->setDisplayColumn(true);
$form->roll->input->teacher->textTip='';

$tabs['List Class'] =  $form->roll->getForm();

$form = _lib('pea', 'school_class');
$form->initEdit(!empty($_GET['id']) ? 'WHERE id='.$_GET['id'] : '');
$form->edit->setSaveTool(true);

// $form->edit->addInput( 'id', 'text' );
// $form->edit->input->id->setFieldName( 'id AS page_id' );
// $form->edit->input->id->setDisplayColumn(true);

$form->edit->addInput( 'grade', 'text' );
$form->edit->input->grade->setFieldName( 'grade' );
$form->edit->input->grade->setRequire();


$form->edit->addInput( 'label', 'text' );
$form->edit->input->label->setFieldName( 'label' );
$form->edit->input->label->setRequire();


$form->edit->addInput( 'major', 'text' );
$form->edit->input->major->setFieldName( 'major' );
$form->edit->input->major->setRequire();

// $form->edit->addInput('class', 'multiinput');
// $form->edit->input->class->setTitle('class');
// $form->edit->input->class->setDelimiter(' ');
// $form->edit->input->class->addInput('grade', 'sqllinks');
// $form->edit->input->class->addInput('major', 'sqllinks');
// $form->edit->input->class->addInput('label', 'sqllinks');

// $form->edit->input->grade->setLinks($Bbc->mod['circuit'].'.class_edit');
// $form->edit->input->major->setLinks($Bbc->mod['circuit'].'.class_edit');
// $form->edit->input->label->setLinks($Bbc->mod['circuit'].'.class_edit');
// $qr = "SELECT name FROM school_teacher WHERE 1";
// $rq = $db->getOne($qr);
// pr($rq, $return = false);
// $form->edit->addInput('teacher', 'select');
// $form->edit->input->teacher->setTitle('teacher');

// $form->edit->input->teacher->setFieldName( 'teacher_id' );
// $form->edit->input->teacher->addOption(implode(',', $rq));

// // $form->edit->input->teacher->setReferenceTable('school_teacher');
// // $form->edit->input->teacher->setReferenceField('name','id');
// // $form->edit->input->teacher->setPlaintext(true);
// $form->edit->input->teacher->textTip='';

$form->edit->addInput('teacher','selecttable');
$form->edit->input->teacher->setFieldName( 'teacher_id' );
$form->edit->input->teacher->setTitle('Add teacher');
$form->edit->input->teacher->addOption('Select Teacher', '');
$form->edit->input->teacher->setReferenceTable('school_teacher');
$form->edit->input->teacher->setReferenceField('name', 'id');
$form->edit->input->teacher->setRequire();

// $form->edit->input->teacher->setReferenceNested();

$tabs['New Class'] =  $form->edit->getForm();
echo tabs($tabs, 1, 'tabs_links');


// test