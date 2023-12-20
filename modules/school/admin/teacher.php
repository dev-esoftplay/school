<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

// $tabs     = array('Daftar Guru' => '', 'Tambah Guru' => '');
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

$form->roll->action();
echo $form->roll->getForm();
// $tabs['Daftar Guru'] = $form->roll->getForm();


// //////
// $form  = _lib('pea', 'school_teacher');
// $form->initEdit(!empty($_GET['id']) ? 'WHERE id='.$_GET['id'] : '');

// $form->edit->addInput('header', 'header');
// $form->edit->input->header->setTitle('Add New Teacher');

// $form->edit->addInput('name', 'text');
// $form->edit->input->name->setRequire();

// $form->edit->addInput('nip', 'text');
// $form->edit->input->nip->setRequire();

// $form->edit->addInput('phone', 'text');
// $form->edit->input->phone->setRequire();

// $form->edit->addInput('position', 'select');
// $form->edit->input->position->setTitle('Position');
// $form->edit->input->position->addOption('Select Position', '');
// $form->edit->input->position->addOption($position);

// $tabs['Tambah Guru'] = $form->edit->getForm();

// echo tabs($tabs, 1, 'tabs_links');