<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$show_list = true;
if (!empty($_POST['template']))
{
	if ($_POST['template'] == 'download')
	{
		$r = array(
			array(
				'No'      => '',
				'Teacher' => '',
				'Class'   => '',
			)
		);
		if (!empty($r))
		{
			_func('download');
			download_excel('Template '.$Bbc->mod['task'].' '.date('Y-m-d').' '.rand(0, 999), $r);
		}else{
			echo msg('Maaf, tidak ada file yg bisa di download', 'danger');
		}
	}
}

if ($show_list)
{
	$form = _lib('pea', 'school_class');
	$form->initSearch();

	?>
	<a href="<?php echo site_url('school/class_add')?>">
	  <button type="button" class="btn btn-info" style="margin: 0px 0px 20px 10px ">Tambahkan Kelas</button>
	</a>
	<?php
	$form->search->addInput('grade', 'select');
	$form->search->input->grade->setTitle('Judul Field');
	$form->search->input->grade->addOption(['10', '11', '12']);

	$form->search->addInput('keyword','keyword');
	$form->search->input->keyword->addSearchField('grade,major,label');

	$add_sql = $form->search->action();
	$keyword = $form->search->keyword();
	echo $form->search->getForm();

	$form->initRoll($add_sql.' ORDER BY id DESC', 'id' );

	$form->roll->setSaveTool(false);

	$form->roll->setDeleteTool(false);

	$form->roll->addInput( 'id', 'sqlplaintext' );
	$form->roll->input->id->setFieldName( 'id AS class_id' );
	$form->roll->input->id->setDisplayColumn(true);

	$form->roll->addInput('id','sqllinks');
	$form->roll->input->id->setFieldName('id AS edit');
	$form->roll->input->id->setLinks($Bbc->mod['circuit'].'.class_edit');

	$form->roll->addInput( 'class_name', 'sqlplaintext' );
	$form->roll->input->class_name->setFieldName( 'CONCAT_WS(" ",grade,label,major) AS class_name' );
	$form->roll->input->class_name->setDisplayColumn(true);

	$form->roll->addInput('grade', 'sqlplaintext');
	$form->roll->input->grade->setTitle('Grade');
	$form->roll->input->grade->setDisplayColumn(false);

	$form->roll->addInput('major', 'sqlplaintext');
	$form->roll->input->major->setTitle('major');
	$form->roll->input->major->setDisplayColumn(false);

	$form->roll->addInput('label', 'sqlplaintext');
	$form->roll->input->label->setTitle('label');
	$form->roll->input->label->setDisplayColumn(false);

	$form->roll->addInput('teacher_id', 'selecttable');
	$form->roll->input->teacher_id->setTitle('Guard Teacher');
	$form->roll->input->teacher_id->setFieldName( 'teacher_id' );
	$form->roll->input->teacher_id->setReferenceTable('school_teacher');
	$form->roll->input->teacher_id->setReferenceField('name','id');
	$form->roll->input->teacher_id->setPlaintext(true);
	$form->roll->input->teacher_id->setDisplayColumn(true);
	$form->roll->input->teacher_id->textTip='';

	$form->roll->addInput('number', 'sqllinks');
	$form->roll->input->number->setTitle('total student');
	$form->roll->input->number->setFieldName('id as total_student');
	$form->roll->input->number->setLinks($Bbc->mod['circuit'].'.class_student');
	$form->roll->input->number->setDisplayFunction(function ($value) use($db)
	{
		// $course_id = $db->getone("SELECT course_id from school_teacher_subject WHERE id=$value");
		$student_number = $db->getone('SELECT count(`number`) FROM `school_student_class` WHERE `class_id` =' . $value);
		return $student_number;
	});

	$form->roll->addReport('excel');
	echo $form->roll->getForm();
}
// include 'class_add.php';
