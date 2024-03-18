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

	$form = _lib('pea', 'school_course');
	$form->initSearch();

	?>
	<!-- <a href="<?php echo site_url('school/course_add')?>">
	  <button type="button" class="btn btn-info" style="margin: 0px 0px 20px 10px ">Tambahkan Course</button>
	</a> -->
	<?php


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

	// $form->roll->addInput('id','sqllinks');
	// $form->roll->input->id->setFieldName('id AS edit');
	// $form->roll->input->id->setLinks($Bbc->mod['circuit'].'.course_edit');

	$form->roll->addInput('course', 'textarea');
	$form->roll->input->course->setTitle('Mata Pelajaran');
	$form->roll->input->course->setFieldName( 'name' );
	$form->roll->input->course->setDisplayColumn(true);
	$form->roll->input->course->setNl2br(false);
	$form->roll->input->course->textTip='';

	$form->roll->addReport('excel');
	$form->roll->action();
	echo $form->roll->getForm();
}

include 'course_add.php';