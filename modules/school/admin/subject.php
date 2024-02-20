<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$show_list = true;
if (!empty($_GET['id']) && !empty($_GET['act']))
{
	$id = intval($_GET['id']);
	switch ($_GET['act'])
	{
		case 'approve':
			include 'approval_withdraw-'.$_GET['act'].'.php';
			break;
	}
	if (!empty($_GET['is_ajax']))
	{
		die();
	}else{
		$sys->nav_add('Event '.ucwords($_GET['act']));
		$show_list = false;
	}
}

if (!empty($_POST['template']))
{
	if ($_POST['template'] == 'download')
	{
		$r = array(
			array(
				'No'      => '',
				'Course'  => '',
				'Teacher' => '',
				'Class'   => '',
			)
		);
		if (!empty($r))
		{
			_func('download');
			download_excel('Template '.date('Y-m-d').' '.rand(0, 999), $r);
		}else{
			echo msg('Maaf, tidak ada file yg bisa di download', 'danger');
		}
	}
}

if ($show_list)
{

	$form = _lib('pea', 'school_teacher_subject');
	$form->initSearch();

	$form->search->addInput('keyword','keyword');
	$form->search->input->keyword->addSearchField('keyword,day,clock_start,clock_end');

	$add_sql = $form->search->action();
	$keyword = $form->search->keyword();
	echo $form->search->getForm();

	$form->initRoll($add_sql.' ORDER BY id DESC', 'id' );
	$form->roll->setSaveTool(false);

	$form->roll->addInput('id', 'sqlplaintext');
	$form->roll->input->id->setTitle('id');
	$form->roll->input->id->setDisplayColumn(true);

	$form->roll->addInput('id','sqllinks');
	$form->roll->input->id->setFieldName('id AS edit');
	$form->roll->input->id->setLinks($Bbc->mod['circuit'].'.subject_edit');

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
	$form->roll->addReport('excel');
	echo $form->roll->getForm();
}

include 'subject_add.php';
