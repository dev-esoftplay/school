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
				'No'       	   => '',
				'Nama'     	   => '',
				'NIP'      	   => '',
				'No HP' 	   => '',
				'Posisi'   	   => '',
				'Taggal lahir' => '',
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
	$position = array('Kepala Sekolah', 'Wakil Kepala Sekolah', 'Guru BK', 'Staff', 'Tukang Kebun');

	$form     = _lib('pea', 'school_teacher');
	$form->initSearch();

	$form->search->addInput('position','select');
	$form->search->input->position->addOption('Select Position', '');
	$form->search->input->position->addOption($position);

	$form->search->addInput('keyword','keyword');
	$form->search->input->keyword->addSearchField('name, nip',  false);

	$add_sql 				 = $form->search->action();
	$keyword 				 = $form->search->keyword($position);
	$position_search = $form->search->action('position');
	echo $form->search->getForm();

	$form  = _lib('pea', 'school_teacher');
	$form->initRoll($add_sql.' ORDER BY name ASC', 'id');

	$form->roll->setSaveTool(false);
	?>
	<a href="<?php echo site_url('school/teacher_add') ?>">
	<button  type="button" class="btn btn-info">Tambah Guru</button>
	</a>
	<?php
	$form->roll->addInput( 'id', 'sqlplaintext' );
	$form->roll->input->id->setDisplayColumn(true);

	$form->roll->addInput('name', 'sqllinks');
	$form->roll->input->name->setTitle('nama');
	$form->roll->input->name->setLinks($Bbc->mod['circuit'].'.teacher_edit');

	$form->roll->addInput('nip', 'sqlplaintext');
	$form->roll->input->nip->setTitle('nip');

	$form->roll->addInput('phone', 'sqlplaintext');
	$form->roll->input->phone->setTitle('no hp');
	$form->roll->input->phone->setDisplayColumn(true);

	$form->roll->addInput('position', 'sqlplaintext');
	$form->roll->input->position->setTitle('posisi');
	$form->roll->input->position->setDisplayColumn(true);

	$form->roll->addInput('birthday', 'sqlplaintext');
	$form->roll->input->birthday->setTitle('Tanggal Lahir');
	$form->roll->input->birthday->setDisplayColumn(true);


	$form->roll->addReport('excel');
	$form->roll->action();
	echo $form->roll->getForm();
}

